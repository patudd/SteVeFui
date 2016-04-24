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

class AjaxController extends DefaultController
{
	/**
	 * Ausgabe der durch Filtern übergebene Liste
	 *
	 * @param object $request Request von der vorhergehenden Seite
	 *
	 * @return html Ausgabe des Schnippsels
	 */
	
	public function loadAjaxDataAction(Request $request){
		$req = $request->request->get('ajax');
		if (!empty($req))
		{			
			switch ($request->request->get('ajax'))
			{
				case "transactions":
						
					$value = $request->request->get('value');
						
					if ($request->request->get('filter')=="t.starttimestamp" || $request->request->get('filter')=="t.stoptimestamp"){
						$value = HelpController::formatDate($value);
					}
					$session_filter = new Session();
					$session_filter->start();
					if ($value!="*")
						$session_filter->set($request->request->get('filter'), $value);
					else
						$session_filter->remove($request->request->get('filter'));
						
					$array_filter = array($request->request->get('filter') => $value);
					$transactions = $this->getDoctrine()->getRepository('SteveFrontendBundle:Transaction')->getTransaction($session_filter->all());
	
					$array_render = array(
							'transactions' => $transactions,
					);
					$template = $this->renderView("SteveFrontendBundle:Ajax:listtransactions.html.twig", $array_render);
						
					break;
				case "users":
					$users = $this->getDoctrine()->getRepository('SteveFrontendBundle:User')->findAll();
					$array_render = array(
							'users' => $users
	
					);
					$template = $this->renderView("SteveFrontendBundle:Ajax:listuser.html.twig", $array_render);
					break;
				case "chargepoint": /* setzt bzw. Update eventuell hier noch verschieben */ 
					$transaction_id = $request->request->get('transaction_id');
					$chargeBoxId = $request->request->get('chargeBoxId');
					$chargebox = $this->getDoctrine()->getRepository('SteveFrontendBundle:Chargebox')->find($chargeBoxId);
	
					$em = $this->getDoctrine()->getManager();
					$transactions = $em->getRepository('SteveFrontendBundle:Transaction')->find($transaction_id);
	
					if (!$transactions) {
						throw $this->createNotFoundException(
								'No Transfer found for id '.$transaction_id
						);
					}
					$now = new DateTime("now");
					$transactions->setStopvalue($transactions->getStartvalue());
					$transactions->setStoptimestamp($now);
					$em->flush();
	
					$array_render = OutputController::createContentChargebox(null, $chargeBoxId);
	
					$template = $this->renderView('SteveFrontendBundle:Ajax:listchargebox.html.twig', $array_render);
					break;					
				default:
					break;
			}
		}
		return new Response($template);
	}
	
}