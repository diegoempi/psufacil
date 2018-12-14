<?php
namespace PsumateBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use PsumateBundle\Services\GlobalFunctions;

class DefaultController extends Controller
{
    public function obtenerColegioAction( Request $request )
    {
        //recibe comuna
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $i                  = 1;
        $arr_comunas        = array();
        $comuna             = $request->get('comuna');
        $em                 = $this->getDoctrine()->getManager();

        $colegios           = $em->getRepository("PsumateBundle:ColegiosDb")
                                ->findBy(array('codComuna' => $comuna ));

        return $GlobalFunctions->json( array(
            'code' => '200',
            'status' => 'success',
            'data'=> $colegios) );
		
    }

    public function obtenerRegionAction()
    {
        dump('obtener region'); die();
        //return $this->render('PsumateBundle:Default:index.html.twig');
    }

    public function obtenerComunaAction( Request $request )
    {
        //recibe region para retornar comuna
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $i                  = 1;
        $arr_comunas        = array();
        $region             = $request->get('region');
        $em                 = $this->getDoctrine()->getManager();
        
        $comunas            = $em->getRepository("PsumateBundle:ColegiosDb")
                                ->findBy(array('codRegion' => $region ));

        foreach ($comunas as $value) {
            $arr_comunas[$i]['id']           = $value->getCodComuna();
            $arr_comunas[$i]['nom_comuna']   = $value->getNomComuna();
            $i++;
        }

        return $GlobalFunctions->json( array(
            'code' => '200',
            'status' => 'success',
            'data'=> $arr_comunas) );

    }    

}
