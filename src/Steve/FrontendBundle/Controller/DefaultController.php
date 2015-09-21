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
	 * Setzen der globalen und immerwiederkehrenden Variablen
	 *
	 * @param string $page Aufruf der Webseite
	 * @global wird in sämlichen Ausgaben benötigt
	 *
	 * @return array $global 
	 */
	public function setGlobalVar($page){				
		$global["url"] = $_SERVER["HTTP_HOST"];
		$global["interface"] = "steve";
		/*$global["interface"] = "ocphp";		*/
		$global["page"] = $page;
		$global["version"] = "0.2.5";
		
		return $global;
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
    			return OutputController::createPageMain($global);
    			break;
    		}  		
    		case "chargebox": {
    			return OutputController::createPageChargebox($global);
    			break;
    		}    		
    		case "transactions": {
    			return OutputController::createPageTransactions($global);
    			break;
    		}
    		case "users": {
    			return OutputController::createPageUsers($global);
    			break;
    		}
    		case "contact": {
    			return OutputController::createPageContact($global);
    			break;
    		}
    		default:{
    			return OutputController::createPageMain($global);
    			break;
    		}
    	}
    }
}
