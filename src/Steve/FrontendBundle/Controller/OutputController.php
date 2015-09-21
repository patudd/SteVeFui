<?php
namespace Steve\FrontendBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Steve\FrontendBundle\Entity\Chargebox;
use Symfony\Component\HttpFoundation\Response;

use Steve\FrontendBundle\Entity\Connector;
use Steve\FrontendBundle\Entity\Transaction;
use Symfony\Component\HttpFoundation\Session\Session;
use \DateTime;

class OutputController extends DefaultController
{
	/**
	 * Erstellen der Haupt bzw. Startseite
	 *
	 * @param array $global
	 *
	 *
	 * @return html Ausgabe
	 */
	public function createPageMain($global){
		$chargeboxes = $this->getDoctrine()->getRepository('SteveFrontendBundle:Chargebox')->findAll();
	
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
				
			// einen Tag nicht erreichbar oder noch nie errechbar
			if (($dif - 60*60*24)>0){
				//if (!empty( (array) $chargeboxe->lastheartbeattimestamp))
				$chargeboxe_new->onlinestatus=0;
			}else if(($dif - 60*60)>0){ // zwei Stunde nicht erreichbar
				$chargeboxe_new->onlinestatus=2;
			}else{
				$chargeboxe_new->onlinestatus=1;
			}
			$chargeboxes_new[] = $chargeboxe_new;
		}
			
		$array_render = array('chargeboxes' => $chargeboxes,
				'global' => $global
		);
	
		if ($this->container->getParameter('kernel.environment')=="dev")
			dump($chargeboxes);
	
		return $this->render('SteveFrontendBundle:Default:index.html.twig', $array_render);
	}
	/**
	 * Erstellen der Übersichtsseite der einzelne Ladestation mit seinen Ladepunkten
	 *
	 * @param array $global
	 *
	 * @return html Ausgabe
	 */
	public function createPageChargebox($global){
		$request = Request::createFromGlobals();   // get GET-Parameters
		$chargeBoxId = $request->query->get('chargeBoxId'); // get the GET Parameter chargeBoxId from the URL
		
		/*$chargeboxes = $this->getDoctrine()->getRepository('SteveFrontendBundle:Chargebox')->find($chargeBoxId);		
		$temp_array_lasttime = (array) $chargeboxes->getLastheartbeattimestamp();
		print_r($temp_array_lasttime);
		die;*/		
		
		$array_render = self::createContentChargebox($global, $chargeBoxId);
		
		
		return $this->render('SteveFrontendBundle:Default:chargebox.html.twig', $array_render);
	
	}
	
	public function createContentChargebox($global, $chargeBoxId){
		$chargebox = $this->getDoctrine()->getRepository('SteveFrontendBundle:Chargebox')->find($chargeBoxId);
	
		if (!$chargebox) {
			throw $this->createNotFoundException(
					'Keine Chargebox gefunden mit der Id:'.$chargeBoxId
			);
		}
		$connector = $this->getDoctrine()->getRepository('SteveFrontendBundle:Connector');
		$connectors = $connector->findBy(
				array('chargeboxid' => $chargeBoxId
				)
		);
	
		$connectors_new=array();
	
		foreach($connectors as $connector) {
	
			$connector_new = $this->getDoctrine()->getRepository('SteveFrontendBundle:Connector')->getConnectorTransaction($connector->getConnectorPk());
	
			$connector_new['statustitel'] =  $connector_new['errorcode'];
			$connector_new['statusmessage'] =  HelpController::getMessage($connector_new['statustitel']);
	
			$connector_new['status'] = $this->get('translator')->trans($connector_new['status']);
			$connector_new['statustitel'] = $this->get('translator')->trans($connector_new['statustitel']);
			$connector_new['statusmessage'] = $this->get('translator')->trans($connector_new['statusmessage']);
	
			$connectors_new[] = $connector_new;
		}
		$users = $this->getDoctrine()->getRepository('SteveFrontendBundle:User')->findAll();
	
		$array_render = array('chargebox' => $chargebox,
				'connectors' => $connectors_new,
				'global' => $global,
				'users' => $users
		);
		if ($this->container->getParameter('kernel.environment')=="dev"){
			dump($connectors_new);
			dump($users);
		}
		return $array_render;	
	}
	/**
	 * Erstellen der Übersichtsseite der Ladevorgängen
	 *
	 * @param array $global
	 *
	 * @return html Ausgabe
	 */
	public function createPageTransactions($global){
		$session_filter = new Session();
		$session_filter->start();
		$session_filter->clear(); // Session löschen beim Seiten neu laden!
		$transactions = $this->getDoctrine()->getRepository('SteveFrontendBundle:Transaction')->getTransaction();
		$users = $this->getDoctrine()->getRepository('SteveFrontendBundle:User')->findAll();
		$chargeboxes = $this->getDoctrine()->getRepository('SteveFrontendBundle:Chargebox')->findAll();
	
		$array_render = array('chargeboxes' => array(),
				'transactions' => $transactions,
				'users' => $users,
				'chargeboxes' => $chargeboxes,
				'global' => $global
		);
		if ($this->container->getParameter('kernel.environment')=="dev"){
			dump($transactions);
			dump($users);
		}
		return $this->render('SteveFrontendBundle:Default:transactions.html.twig', $array_render);
	}
	/**
	 * Erstellen der Übersichtsseite der hinterlegten RFID-Karten
	 *
	 * @param array $global
	 *
	 * @return html Ausgabe
	 */
	public function createPageUsers($global){
		$users = $this->getDoctrine()->getRepository('SteveFrontendBundle:User')->findAll();
		$array_render = array('chargeboxes' => array(),
				'users' => $users,
				'global' => $global
		);
		if ($this->container->getParameter('kernel.environment')=="dev"){
			dump($users);
		}
		return $this->render('SteveFrontendBundle:Default:users.html.twig', $array_render);
	}
	/**
	 * Kontakt-Seite
	 *
	 * @param array $global
	 *
	 * @return html Ausgabe
	 */
	public function createPageContact($global){
		$users = $this->getDoctrine()->getRepository('SteveFrontendBundle:User')->findAll();
		$array_render = array('chargeboxes' => array(),
				'global' => $global
		);
		if ($this->container->getParameter('kernel.environment')=="dev"){
			dump($users);
		}
		return $this->render('SteveFrontendBundle:Default:contact.html.twig', $array_render);
	}
}