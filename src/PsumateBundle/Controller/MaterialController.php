<?php 
namespace PsumateBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints as Assert;
use PsumateBundle\Services\GlobalFunctions;
use Symfony\Component\Validator\Constraints\DateTime;

use PsumateBundle\Services\JwtAuth;
use PsumateBundle\Entity\Usuarios;
use PsumateBundle\Entity\Unidades;
use PsumateBundle\Entity\Capitulos;
use PsumateBundle\Entity\Videos;
use PsumateBundle\Entity\Material;
use PsumateBundle\Entity\Revision;
use PsumateBundle\Entity\RevisionUnidad;
use PsumateBundle\Entity\RevisionLista;
use PsumateBundle\Entity\RevisionCorrectas;
use PsumateBundle\Entity\RevisionDetalle;
use PsumateBundle\Entity\MaterialUnidad;
use PsumateBundle\Entity\MaterialCapitulo;


class MaterialController extends Controller
{
    public function IngresarAdmMaterialUnidadAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $descripcion        = $request->get( 'descripcion', null );
        $imagen             = $request->files->get( 'imagen', null );
        $suscripcion        = $request->get( 'suscripcion', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token, null );
        
        
        if( $authCheck ){
            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$descripcion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra descripcion' ); }
            if( !$imagen ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra imagen' ); }

            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();
                $ext                = $imagen->guessExtension();
                $file_name          = time().".".$ext;
                $imagen->move("uploads/material/unidades", $file_name);

                //grabo en bd la nueva unidad creada
                $unidad = new MaterialUnidad();
                $unidad->setNombre( $nombre );
                $unidad->setDescripcion( $descripcion );
                $unidad->setUrl( $file_name );
                $unidad->setUsrSuscripcion( $suscripcion );
                $fechaIngreso    = new \DateTime("now");
                $unidad->setFechaDeCreacion( $fechaIngreso );
      
                $em->persist( $unidad );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la unidad correctamente',
                    'data'      => $unidad  );
            }
        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'error',
                'msj'       => 'Token invalido',
                'data'      => null );
        }
        return $GlobalFunctions->json( $data ); 
    }

    

    public function ObtenerAdmMaterialUnidadAction( Request $request  ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null );
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_unidades       = array();

        if( $authCheck ){
            $em                 = $this->getDoctrine()->getManager();
            $dql                = "SELECT a.id, a.nombre, a.descripcion, a.url FROM PsumateBundle:MaterialUnidad a GROUP BY a.id ORDER BY a.id ASC";
            //dump($dql); die();
            $unidadesObject     = $em->createQuery($dql);
            $arr_unidades       = $unidadesObject->getResult();

            if( $arr_unidades != null ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto las unidades correctamente',
                    'data'      => $arr_unidades ); 
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'no se encontraron unidades',
                    'data'      => null );
            }
        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'token_invalid',
                'msj'       => 'token invalido',
                'data'      => $arr_unidades );  
        }
        return $GlobalFunctions->json( $data ); 
    }


    public function IngresarAdmMaterialCapituloAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $descripcion        = $request->get( 'descripcion', null );
        $unidad             = $request->get( 'unidad', null );
        //$imagen             = $request->files->get( 'imagen', null );
        $suscripcion        = $request->get( 'suscripcion', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token, null );
        
        
        if( $authCheck ){
            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$descripcion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra descripcion' ); }
            //if( !$imagen ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra imagen' ); }
            if( !$unidad ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra unidad' ); }
            

            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();
                //$ext                = $imagen->guessExtension();
                //$file_name          = time().".".$ext;
                //$imagen->move("uploads/material/unidades", $file_name);

                //grabo en bd la nueva unidad creada
                $capitulo = new MaterialCapitulo();
                $capitulo->setNombre( $nombre );
                $capitulo->setDescripcion( $descripcion );
                $capitulo->setIdUnidades( $unidad );
                $capitulo->setUsrSuscripcion( $suscripcion );
                $fechaIngreso    = new \DateTime("now");
                $capitulo->setFechaDeCreacion( $fechaIngreso );

                $em->persist( $capitulo );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la unidad correctamente',
                    'data'      => $capitulo  );
            }
        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'error',
                'msj'       => 'Token invalido',
                'data'      => null );
        }
        return $GlobalFunctions->json( $data ); 
    }


    public function ObtenerAdmMaterialCapitulosAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $unidad             = $request->get( 'unidad', null ); 
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_capitulos      = array();

        if( $authCheck ){
            $em             = $this->getDoctrine()->getManager();

            //dump( $unidad ); die();

            if( $unidad ){
                $dql                = "SELECT a.id, a.nombre, a.descripcion 
                                        FROM PsumateBundle:MaterialCapitulo a 
                                        WHERE a.idUnidades = $unidad 
                                        GROUP BY a.id 
                                        ORDER BY a.id 
                                        ASC";
            }else{
                $dql                = "SELECT a.id, a.nombre, a.url, a.descripcion 
                                        FROM PsumateBundle:MaterialCapitulo a 
                                        GROUP BY a.id ORDER BY a.id ASC";
            }


            //dump( $dql ); die();
            $capitulosObject    = $em->createQuery($dql);
            $arr_capitulos      = $capitulosObject->getResult();
           
            if( !empty($arr_capitulos) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto los capitulos correctamente',
                    'data'      => $arr_capitulos );
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'No se encuentran capitulos disponibles',
                    'data'      => null );
            }
        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'token_invalid',
                'msj'       => 'token invalido',
                'data'      => null );  
        }
        return $GlobalFunctions->json( $data ); 
    }

    
    public function IngresarAdmMaterialAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $unidad             = $request->get( 'unidad', null );
        $capitulo           = $request->get( 'capitulo', null );
        $descripcion        = $request->get( 'descripcion', null );
        $pdf                = $request->files->get( 'pdf', null );
        $suscripcion        = $request->get( 'suscripcion', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token, null );
        
        
        if( $authCheck ){
            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$descripcion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra descripcion' ); }
            if( !$pdf ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra pdf' ); }

            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();
                $ext                = $pdf->guessExtension();
                $file_name          = time().".".$ext;

                $pdf->move("uploads/material/pdf", $file_name);

                //grabo en bd la nueva unidad creada
                $material = new Material();
                $material->setNombre( $nombre );
                $material->setDescripcion( $descripcion );
                $material->setUrl( $file_name );
                $material->setIdUnidades( $unidad );
                $material->setIdCapitulos( $capitulo );
                $material->setUsrSuscripcion( $suscripcion );
                $fechaIngreso    = new \DateTime("now");
                $material->setFechaDeCreacion( $fechaIngreso );
      
                $em->persist( $material );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la unidad correctamente',
                    'data'      => $material  );
            }
        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'error',
                'msj'       => 'Token invalido',
                'data'      => null );
        }
        return $GlobalFunctions->json( $data ); 
    }


    public function ObtenerMaterialAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $unidad             = $request->get( 'unidad', null ); 
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_capitulos      = array();




        if( $authCheck ){
            $em             = $this->getDoctrine()->getManager();

            //dump( $unidad ); die();

            if( $unidad ){
                $dql                = "SELECT a.id, a.nombre, a.descripcion, a.url
                                        FROM PsumateBundle:Material a 
                                        WHERE a.idUnidades = $unidad 
                                        GROUP BY a.id 
                                        ORDER BY a.id 
                                        ASC";
            }else{
                $dql                = "SELECT a.id, a.nombre, a.url, a.descripcion 
                                        FROM PsumateBundle:Material a 
                                        GROUP BY a.id ORDER BY a.id ASC";
            }


            //dump( $dql ); die();
            $capitulosObject    = $em->createQuery($dql);
            $arr_capitulos      = $capitulosObject->getResult();
           
            if( !empty($arr_capitulos) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto los capitulos correctamente',
                    'data'      => $arr_capitulos );
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'No se encuentran capitulos disponibles',
                    'data'      => null );
            }
        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'token_invalid',
                'msj'       => 'token invalido',
                'data'      => null );  
        }
        return $GlobalFunctions->json( $data ); 
    }


}