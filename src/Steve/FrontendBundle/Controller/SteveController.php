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


/**
 * Steve Controller
 *
 * @author patu radFeld
 * @version 0.2
 * @category Schnittstelle
 */


class SteveController extends InterfaceController
{
	private static $steve_username = "steve";
	private static $steve_password = "steve";
	
	private static $htaccess_username = "steve";
	private static $htaccess_password = "steve";
	
	function __construct() {
		
	}
	
	public function sendData($post_array){
		
		self::login($post_array);
		
		if (strpos($post_array["ocppversion"], "1.2"))
			$post_array["ocppversion"]="1.5";
		if (strpos($post_array["ocppversion"], "1.5"))
			$post_array["ocppversion"]="1.5";
		if (strpos($post_array["ocppversion"], "2.0"))
			$post_array["ocppversion"]="2.0";
		
		switch ($post_array['object']){			
			case 'user': // bezieht sich alles auf Ladekarten!
				$post_array['pfad'] = "/steve/manager/users/" . $post_array['action'];
				self::postDate($post_array);
				
				break;
			case 'chargebox':
				
				if ($post_array['action']=="Update"){					
					$post_array['action']="ChangeConfiguration"; // Action wird entsprechend angepasst
					$post_array['confKey']="HeartBeatInterval";
					$post_array['value']="1";
					
					$post_array['pfad'] = "/steve/manager/operations/v".$post_array['ocppversion']."/" . $post_array['action'];
					self::postDate($post_array);
					sleep(3);
					$post_array['value']="100";
					self::postDate($post_array);
					
				}else{ /* z.B. Reset */
					$post_array['pfad'] = "/steve/manager/operations/v".$post_array['ocppversion']."/" . $post_array['action'];
					self::postDate($post_array);
				}				
				break;
			default:
				$post_array['pfad'] = "/steve/manager/operations/v".$post_array['ocppversion']."/" . $post_array['action'];
				self::postDate($post_array);
		}
				
	}
	
	private function postDate($post_array){
		$login = "".self::$htaccess_username.":".self::$htaccess_password.""; // Benutzerdaten (Username und Passwort)
		$fields = array(
				'resetType' => urlencode($post_array['resetType']),
				'idtag' => urlencode($post_array['idtag']),
				'value' => urlencode($post_array['value']),
				'confKey' => urlencode($post_array['confKey']),
				'transactionid' => urlencode($post_array['transactionid']),
				'ocppversion' => urlencode($post_array['ocppversion']),
				'action' => urlencode($post_array['action']),
				'_chargePointSelectList' => urlencode(1),
				'chargePointSelectList' => urlencode($post_array['chargePointSelectList']),
				'parentIdTag' => urlencode($post_array['parentIdTag']),
				'idTag' => urlencode($post_array['idTag']),
				'blocked' => urlencode($post_array['blocked']),
				'connectorId' => urlencode($post_array['connectorId']),
				
		);		
		
		$fields = array_filter($fields);
		$url ="http://". $post_array['domain'] . $post_array['pfad']; // URL, auf die zugegriffen wird
		
		$fields_string = "";
		
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		//open connection
		
		$ch = curl_init(); // Erstellen eine Variable als CURL und öffnen die Sitzung
		curl_setopt ($ch, CURLOPT_URL, $url); // Speichern URL in Optionen
		curl_setopt ($ch, CURLOPT_HEADER, 0); // Legen fest, ob Header im Inhalt gespeichert werden soll
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); // Folgen der Umleitung
		curl_setopt ($ch, CURLOPT_USERPWD, $login); // Speichern Login-Daten in Optionen
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		//echo $url;
		//print_r($response);
		
		if (empty($response)) {
			throw new \Exception('No Request sending Data');
		}
		return 1;
		
	}	
	private function login($post_array){			
		$login = "".self::$htaccess_username.":".self::$htaccess_password.""; // Benutzerdaten (Username und Passwort)	
		$fields = array(
				'username' => urlencode(self::$steve_username),
				'password' => urlencode(self::$steve_password)				
		);
		$fields = array_filter($fields);
		$url ="http://". $post_array['domain'] ."/steve/manager/signin"; // URL, auf die zugegriffen wird
		
		$fields_string = "";
		
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		//open connection
		
		$ch = curl_init(); // Erstellen eine Variable als CURL und öffnen die Sitzung
		curl_setopt ($ch, CURLOPT_URL, $url); // Speichern URL in Optionen
		curl_setopt ($ch, CURLOPT_HEADER, 0); // Legen fest, ob Header im Inhalt gespeichert werden soll
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); // Folgen der Umleitung
		curl_setopt ($ch, CURLOPT_USERPWD, $login); // Speichern Login-Daten in Optionen
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		
		if (empty($response)) {
			throw new \Exception('No Request for login');
		}
		return 1;		
	}	
}

?>