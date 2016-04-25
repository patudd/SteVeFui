<?php
namespace Steve\FrontendBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Steve\FrontendBundle\Controller\MailController;
use Steve\FrontendBundle\Entity\Chargebox;
use Steve\FrontendBundle\Entity\Log;
use \DateTime;

class TaskRunCommand extends ContainerAwareCommand
{
	private $output;

	protected function configure()
	{
		$this
		->setName('task:run')
		->setDescription('Runs Cron Tasks if needed')
		->addArgument("action", InputArgument::OPTIONAL)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln("<comment>Running Cron Tasks $input</comment>");
	
		
		$output->writeln('<comment>Action: '.$input->getArgument('action').'</comment>');
		
		
		switch ($input->getArgument('action'))
		{
			case "checkstation":
				self::runCheckStation($input, $output);
				break;
			case "checkchargingtime":
				self::runCheckChargingTime($input, $output);
				break;
			default:
				return 0;
				break;
		}
		

		$output->writeln('<comment>Done!</comment>');
	}
	private function runCheckStation(InputInterface $input, OutputInterface $output){
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		$chargeboxes = $em->getRepository('SteveFrontendBundle:Chargebox')->findAll();
		
		foreach($chargeboxes as $chargeboxe) {
			$chargeboxe_new = $chargeboxe;
		
			$station = 0;
			// aktuelle zeit
			// Beachten, dass die Serverzeit UTC (Weltzeit) ist und für die Darstellung geändert werden muss
			$temp_array_lasttime = (array) $chargeboxe_new->getLastheartbeattimestamp();
			if (!empty($temp_array_lasttime))
				$station = $chargeboxe_new->getLastheartbeattimestamp()->getTimestamp();
		
			//$chargeboxe_new->getLastheartbeattimestamp()->setTimezone(new DateTimeZone("Europe/Berlin"));
		
			$dif = time() - $station;
			
			// eine Stunde nicht erreichbar oder noch nie errechbar
			if (($dif - 60*60)>0){
				$time  = new \DateTime();
				$time->setTimestamp($dif);
				$subject = 'Ladestation '. $chargeboxe->getChargeboxid() . ' offline!';
				$message = 'Die Ladestation '. $chargeboxe->getChargeboxid() . ' hat seit '.$time->format("z \\T\\a\\g\\e H \\S\\t\\u\\n\\d\\e\\n\\ i \\M\\i\\n\\u\\t\\e\\n").' nicht mehr geantwortet.';
				$parameter_array = array('subject'=> $subject,
										'message'=>$message );
				$service = $this->getContainer()->get("app.email_controller");
				$service->sendAction($parameter_array);
				
				$log = new Log();
				$log->setSubject($subject);
				$log->setMessage($message);
				$log->setCode("100");
				$time->setTimestamp(time());
				$log->setInserttimestamp($time);
				$em->persist($log);
				$em->flush();
				
				$output->writeln('<comment>'.  $time->format("Y:m:d H:i:s") .' Mail: '. $subject. '</comment>');
			}
		}
		
		return 1;
	}
	/* Überprüft die Zeit, wie lange ein Ladevorgang gedauert hat 
	 * und versendet eine E-Mail wenn er zu kurz war.
	 */
	
	private function runCheckChargingTime(InputInterface $input, OutputInterface $output){
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		$transactions = $em->getRepository('SteveFrontendBundle:Transaction')->getTransaction();
		
		$time  = new \DateTime();
		
		foreach($transactions as $transaction) {
			
			$time = $transaction['durationtimestamp'];
			if (!empty($time)){
				if ($time->getTimestamp()<36000){
					$subject = 'Ladevorgang abgebrochen Transaktion-ID '. $transaction['transactionPk'] . '!';
					$message = 'Ladevorgang dauerte nur ' . $time->getTimestamp() . ' Sekunden. Vermutlich wurde der Ladevorgang mit der Transaktion-ID  '. $transaction['transactionPk'] . ' abgebrochen.';
					$parameter_array = array(
							'subject'=> $subject,
							'message'=> $message);
									
					
					$service = $this->getContainer()->get("app.email_controller");
					$service->sendAction($parameter_array);
					
					$log = new Log();
					$log->setSubject($subject);
					$log->setMessage($message);
					$log->setCode("200");
					$time->setTimestamp(time());
					$log->setInserttimestamp($time);
					$em->persist($log);
					$em->flush();
					
					$output->writeln('<comment>'.  $time->format("Y:m:d H:i:s") .' Mail: ' .$subject. '</comment>');
				}	
			}
		}
	}
		
}

