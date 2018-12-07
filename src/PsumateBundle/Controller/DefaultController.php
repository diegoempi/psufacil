<?php
namespace PsumateBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    public function obtenerColegioAction()
    {
		$em = $this->getDoctrine()->getManager();      
		$return = array();
        exit;

		//$idGenTemporadaVersion = $this->get('global_functions')->getTemporadaVersion();

		if($row = $em->getRepository('CampoSeguroBundle:genSector')->obtenerLineas(array('idGenTemporadaVersion' => $idGenTemporadaVersion))){
			$return = $this->get('global_functions')->classToJson($row);
		}
		return new JsonResponse($return);

        //return $this->render('PsumateBundle:Default:index.html.twig');
    }

    public function obtenerRegionAction()
    {
        dump('obtener region'); die();
        //return $this->render('PsumateBundle:Default:index.html.twig');
    }

    public function obtenerComunaAction()
    {
        dump('obtener comuna'); die();
        //return $this->render('PsumateBundle:Default:index.html.twig');
    }    

}
