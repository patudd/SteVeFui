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
 * OCPP PHP Controller
 *
 * @author Patrick Pietsch
 * @version 0.2
 * @category Schnittstelle
 */


class OCPHPController extends InterfaceController
{
	private static $username = "ocphp";
	private static $password = "ocphp";
	private static $key = "R62A3uSGuU3W45e725324%?4!3462w7f4tzA";
	
	function __construct() {
		
	}
	
	public function sendData($post_array){
				
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
					
				}else{
					if (isset($post_array['chargePointSelectList']))
					{
						$chargePoint_array = preg_split("/[\s;]+/", $post_array['chargePointSelectList']);
						$chargePoint_array['type']=$chargePoint_array[0];
						$chargePoint_array['identity']=$chargePoint_array[1];
						$chargePoint_array['location']=$chargePoint_array[2];
					
						$post_array = array_merge($post_array, $chargePoint_array);
					}
					
					self::postDate($post_array);
				}			
				
				break;
			default:
				$post_array['pfad'] = "/steve/manager/operations/v".$post_array['ocppversion']."/" . $post_array['action'];
				self::postDate($post_array);
			
		}
		
				
	}
	
	private function postDate($post_array){
		
		
		
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
				'key' => urlencode(self::$key),
				'type' => urlencode($post_array['type']),
				'identity' => urlencode($post_array['identity']),
				'location' => urlencode($post_array['location']),
		);		
		
		$fields = array_filter($fields);
		$url ="http://ocphp.ux-efztest/ocphp.php"; // URL, auf die zugegriffen wird
		//$url ="http://". $post_array['domain'] . "/ocphp/"; // URL, auf die zugegriffen wird
		echo $url;
		
		$fields_string = "";
		
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		//open connection
		
		$ch = curl_init(); // Erstellen eine Variable als CURL und öffnen die Sitzung
		curl_setopt ($ch, CURLOPT_URL, $url); // Speichern URL in Optionen
		curl_setopt ($ch, CURLOPT_HEADER, 0); // Legen fest, ob Header im Inhalt gespeichert werden soll
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		//echo $url;
		print_r($response);
		
		if (empty($response)) {
			throw new \Exception('No Request sending Data');
		}
		return 1;			
	}	
}

?>