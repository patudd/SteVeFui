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
 * Diese Klasse bestimmt die Schnittstelle zum Steve und gegebenenfalls weitere Schnittstellen
 *
 * @author Patrick Pietsch
 * @version 0.2
 * @category Schnittstelle
 */


class InterfaceController extends DefaultController
{	
	public function loadInterfaceDataAction(Request $request){		
		$post_array = array();
		
		$post_array['object'] = $request->request->get('object');
		$post_array['action'] = $request->request->get('action');
		
		
		$post_array['interface'] = $request->request->get('interface');
		$post_array['resetType'] = $request->request->get('resetType');
		$post_array['idtag'] = $request->request->get('idtag');
		$post_array['value'] = $request->request->get('value');
		$post_array['confKey'] = $request->request->get('confKey');
		$post_array['transactionid'] = $request->request->get('transactionid');
		$post_array['ocppversion'] = $request->request->get('ocppversion');
		$post_array['chargePointSelectList'] = $request->request->get('chargePointSelectList');
		$post_array['domain'] = $request->request->get('domain');
		// Ladekarten
		$post_array['parentIdTag'] = $request->request->get('parentIdTag');
		$post_array['idTag'] = $request->request->get('idTag');
		$post_array['blocked'] = $request->request->get('blocked');		
		$post_array['connectorId'] = $request->request->get('connectorId');
		
		switch ($post_array['interface'])	
		{
			default:
			case 'steve':
				$return = SteveController::sendData($post_array);
				break;
			case 'ocphp':			
				$return = OCPHPController::sendData($post_array);
				break;
			break;
		}		
		$return_array = array("return"=>$return);
		$template = $this->renderView('SteveFrontendBundle:Ajax:empty.html.twig', $return_array);		
		return new Response($template);
	}
}

?>