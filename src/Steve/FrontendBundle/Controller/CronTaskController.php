<?php
namespace Steve\FrontendBundle\Controller;

use Steve\FrontendBundle\Entity\Crontask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class CronTaskController extends Controller
{

	public function testAction()
	{
		$entity = new Crontask();
die("die()");
		$entity
		->setName('Check Charging Time')
		->setInterval(3600) // Run once every hour
		->setCommands(array(
				'task:run checkchargingtime'
		));

		$em = $this->getDoctrine()->getManager();
		$em->persist($entity);
		$em->flush();

		return new Response('OK!');
	}
}