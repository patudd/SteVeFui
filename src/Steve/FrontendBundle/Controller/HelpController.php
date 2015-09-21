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

class HelpController extends DefaultController
{
	/**
	 * Hilfsfunktion zum drehen des Datums vom deutschen ins englische Format
	 * @param string $value deutsches Datum
	 *
	 * @return string $value englisches Datum (Datetime)
	 *
	 */
	public function formatDate($value){
		$array_date = explode(".", $value);
		$array_date = array_reverse($array_date);
		$date_str = "";
		foreach( $array_date as $key => $val ) {
			$date_str.=$val."-";
		}
		$date_str = substr($date_str, 0, -1);
		$value = $date_str;
		return $value;
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