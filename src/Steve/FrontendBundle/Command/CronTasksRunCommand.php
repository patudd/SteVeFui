<?php
namespace Steve\FrontendBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Command\Command;

class CronTasksRunCommand extends ContainerAwareCommand
{
	private $output;

	protected function configure()
	{
		$this
		->setName('crontasks:run')
		->setDescription('Runs Cron Tasks if needed')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln("<comment>Running Cron Tasks $input</comment>");
		
		$this->output = $output;
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		$crontasks = $em->getRepository('SteveFrontendBundle:Crontask')->findAll();
		foreach ($crontasks as $crontask) {
			
			// Get the last run time of this task, and calculate when it should run next
			$lastrun = $crontask->getLastRun() ? $crontask->getLastRun()->format('U') : 0;
			$nextrun = $lastrun + $crontask->getInterval();

			// We must run this task if:
			// * time() is larger or equal to $nextrun
			$run = (time() >= $nextrun);
			$output->writeln("<comment>$run</comment>");			
			if ($run) {
				$output->writeln(sprintf('Running Cron Task <info>%s</info>', $crontask->getName()));
				
				// Set $lastrun for this crontask
				$crontask->setLastRun(new \DateTime());

				try {
					$commands = $crontask->getCommands();
					
					$output->writeln(sprintf('Executing command <comment>%s</comment>...', $commands));
					$this->runCommand($commands);
					
					//$this->runCommand($command);
					/*foreach ($commands as $command) {
						$output->writeln(sprintf('Executing command <comment>%s</comment>...', $command));

						// Run the command
						$this->runCommand($command);
					}*/

					$output->writeln('<info>SUCCESS</info>');
				} catch (\Exception $e) {
					$output->writeln('<error>ERROR</error>');
					$output->writeln('<error> '.$e->getMessage() .'</error>');
				}

				// Persist crontask
				$em->persist($crontask);
			} else {
				$output->writeln(sprintf('Skipping Cron Task <info>%s</info>', $crontask->getName()));
			}
		}

		// Flush database changes
		$em->flush();

		$output->writeln('<comment>Done!</comment>');
	}

	private function runCommand($string)
	{
		// Split namespace and arguments
		$namespace = explode(' ', $string)[0];

		// Set input
		$command = $this->getApplication()->find($namespace);
		$input = new StringInput($string);
		$returnCode = $command->run($input, $this->output);

		return $returnCode != 0;
	}
}

