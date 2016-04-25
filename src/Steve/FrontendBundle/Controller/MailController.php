<?php
namespace Steve\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
	private $templating;
	private $mailer;
	
	public function __construct(EngineInterface $templating, \Swift_Mailer $mailer)
	{
		$this->templating = $templating;
		$this->mailer = $mailer;
	}
	/**
	 * sendet eine E-Mail
	 *
	 * @return bool wenn erfolgreich
	 */
	
	public function sendAction($parameter_array){		
		$Response = new Response();
		$message = \Swift_Message::newInstance()
		->setSubject($parameter_array["subject"])
		->setFrom('efztest@drewag.de')
		->setTo('Patrick_Pietsch@drewag-netz.de')
		->setBody(
				$this->templating->renderResponse(
						// app/Resources/views/Emails/registration.html.twig
						'SteveFrontendBundle:Emails:check.html.twig',
						array('message' => $parameter_array['message']							
						)
				),
				'text/html'
		);
		;
		
		
		//$Response->get('mailer')->send($message);
		$this->mailer->send($message);
		
		
		return $Response;
	}
	
}