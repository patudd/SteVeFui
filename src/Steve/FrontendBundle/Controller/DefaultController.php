<?php
namespace Steve\FrontendBundle\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Steve\FrontendBundle\Entity\Chargebox;
use Symfony\Component\HttpFoundation\Response;

use Steve\FrontendBundle\Entity\Connector;
use Steve\FrontendBundle\Entity\Transaction;



/*
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
*/

/**
 * Diese Klasse bestimmt die Ausgabe der Weboberfläche
 *
 * @author Patrick Pietsch
 * @version 0.2
 * @category Ausgabe für Präsentation
 */


class DefaultController extends Controller
{	
	/**
	 * Ausgabe der durch Filtern übergebene Liste
	 *
	 * @param object $request Request von der vorhergehenden Seite
	 *
	 * @return html Ausgabe des Schnippsels
	 */
	
	public function loadAjaxDataAction(Request $request){		
		$transactions = $this->getDoctrine()->getRepository('SteveFrontendBundle:Transaction')->getTransaction(array($request->request->get('filter') => $request->request->get('value')));		
		$array_render = array(
				'transactions' => $transactions,
				
		);		
		$template = $this->renderView("SteveFrontendBundle:Default:listtransactions.html.twig", $array_render);
		return new Response($template);
	}
	
	/**
	 * Setzen der globalen und immerwiederkehrenden Variablen
	 *
	 * @param string $page Aufruf der Webseite
	 * @global wird in sämlichen Ausgaben benötigt
	 *
	 * @return array $global 
	 */
	public function setGlobalVar($page){				
		$global["url"] = $_SERVER["HTTP_HOST"];
		$global["username_steve"] = "steve";
		$global["password_steve"] = "steve";
		$global["page"] = $page;
		
		return $global;
	}
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
			$connector_new['statusmessage'] =  self::getMessage($connector_new['statustitel']);
			 
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
		
		return $this->render('SteveFrontendBundle:Default:chargebox.html.twig', $array_render);
		
	}
	/**
	 * Erstellen der Übersichtsseite der Ladevorgängen
	 *
	 * @param array $global
	 *
	 * @return html Ausgabe
	 */
	public function createPageTransactions($global){
		$transactions = $this->getDoctrine()->getRepository('SteveFrontendBundle:Transaction')->getTransaction();
		
		$users = $this->getDoctrine()->getRepository('SteveFrontendBundle:User')->findAll();
		
		$array_render = array('chargeboxes' => array(),
				'transactions' => $transactions,
				'users' => $users,
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
	 * Erstellen der Übersichtsseite der hinterlegten RFID-Karten
	 *
	 * @param array $global
	 * @todo Fehlerseite bei Default und somit falscher Pfadangabe
	 *
	 * @return html Ausgabe
	 */
    public function indexAction($page="")
    {    	  	    	
    	$global = self::setGlobalVar($page);
    	switch ($page){
    		case "main": {
    			return self::createPageMain($global);
    			break;
    		}  		
    		case "chargebox": {
    			return self::createPageChargebox($global);
    			break;
    		}
    		
    		case "transactions": {
    			return self::createPageTransactions($global);
    			break;
    		}
    		case "users": {
    			return self::createPageUsers($global);
    			break;
    		}
    		default:{
    			return self::createPageMain($global);
    			break;
    		}
    	}
    }
    
    /**
     * Zuweisung einer Nachricht anhand von einem Fehlercode
     *
     * @param string $code 
     *
     * @return string
     */
    
    public function getMessage($code)
    {
    	$arrayMessage["ConnectorLockFailure"]="Failure to lock or unlock connector.";
    	$arrayMessage["GroundFailure"]= "Ground fault circuit interrupter has been activated.";
    	$arrayMessage["HighTemperature"]="Temperature inside charge point is too high.";
    	$arrayMessage["Mode3Error"]= "Problem with Mode 3 connection to vehicle.";
    	$arrayMessage["NoError"]= "No error to report."; 	
    	$arrayMessage["OtherError"]="Other type of error. More information in vendorErrorCode.";
    	$arrayMessage["OverCurrentFailure"]= "Over current protection device has tripped.";
    	$arrayMessage["PowerMeterFailure"]="Failure to read power meter.";
    	$arrayMessage["PowerSwitchFailure"]= "Failure to control power switch.";
    	$arrayMessage["ReaderFailure"]="Failure with ID tag reader.";
    	$arrayMessage["ResetFailure"]= "Unable to perform a reset.";
    	$arrayMessage["UnderVoltage"]="Voltage has dropped below an acceptable level.";
    	$arrayMessage["WeakSignal"]= "Wireless communication device reports a weak signal.";
    	
    	if (!empty($arrayMessage[$code]))
    	{
    		return $arrayMessage[$code];
    	}else{
    		return ;
    	}
    	
    }
}
