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

class VideosController extends Controller
{
    public function obtenerUnidadesAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null );
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_unidades       = array();

        if( $authCheck ){

            $em                 = $this->getDoctrine()->getManager();
            $dql                = "SELECT a.id, a.nombre, a.descripcion, a.url FROM PsumateBundle:Unidades a WHERE a.usrSuscripcion = $suscripcion GROUP BY a.id ORDER BY a.id ASC";
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

    public function obtenerCapitulosAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $unidad             = $request->get( 'unidad', null ); 
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_capitulos      = array();

        if( $authCheck ){
            $em                 = $this->getDoctrine()->getManager();

            if( $unidad ){
                $dql                = "SELECT a.id, a.nombre, a.url, a.descripcion 
                                        FROM PsumateBundle:Capitulos a 
                                        WHERE a.idUnidades = $unidad 
                                        AND a.usrSuscripcion = $suscripcion 
                                        GROUP BY a.id 
                                        ORDER BY a.id 
                                        ASC";
            }else{
                $dql                = "SELECT a.id, a.nombre, a.url, a.descripcion 
                                        FROM PsumateBundle:Capitulos a 
                                        WHERE a.usrSuscripcion = $suscripcion                                      
                                        GROUP BY a.id ORDER BY a.id ASC";
            }


            //dump($dql); die(); 
            
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



    public function obtenerAdmCapitulosAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $unidad             = $request->get( 'unidad', null ); 
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_capitulos      = array();

        if( $authCheck ){
            $em                 = $this->getDoctrine()->getManager();

            if( $unidad ){
                $dql                = "SELECT a.id, a.nombre, a.url, a.descripcion 
                                        FROM PsumateBundle:Capitulos a 
                                        WHERE a.idUnidades = $unidad 
                                        GROUP BY a.id 
                                        ORDER BY a.id 
                                        ASC";
            }else{
                $dql                = "SELECT a.id, a.nombre, a.url, a.descripcion 
                                        FROM PsumateBundle:Capitulos a                              
                                        GROUP BY a.id ORDER BY a.id ASC";
            }


            //dump($dql); die(); 
            
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


    public function obtenerAdmUnidadesAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_unidades       = array();

        if( $authCheck ){

            $em                 = $this->getDoctrine()->getManager();
            $dql                = "SELECT a.id, a.nombre, a.descripcion, a.url FROM PsumateBundle:Unidades a GROUP BY a.id ORDER BY a.id ASC";
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




    public function obtenerVideosAction( Request $request ){
        
        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $capitulo           = $request->get( 'capitulo', null );
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_videos         = array();

        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.nombre, a.descripcion, a.url FROM PsumateBundle:Videos a WHERE a.idCapitulo = $capitulo AND a.usrSuscripcion = $suscripcion GROUP BY a.id ORDER BY a.id DESC";
            $videosObject    = $em->createQuery($dql);
            $arr_videos      = $videosObject->getResult();
         
            if( !empty($arr_videos) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto los videos correctamente',
                    'data'      => $arr_videos );
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



    public function obtenerTodosCapitulosAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        //$unidad             = $request->get( 'unidad', null ); 
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_capitulos      = array();

        if( $authCheck ){
            $em                 = $this->getDoctrine()->getManager();
            $dql                = "SELECT a.id, a.nombre FROM PsumateBundle:Capitulos a GROUP BY a.id ORDER BY a.id ASC";
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





    public function obtenerVideosTodosAction( Request $request ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        //$capitulo           = $request->get( 'capitulo', null ); 
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_videos         = array();

//dump( $token ); die();

        if( $authCheck ){
            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.nombre, a.url FROM PsumateBundle:Videos a GROUP BY a.id ORDER BY a.id ASC";
            $videosObject    = $em->createQuery($dql);
            $arr_videos      = $videosObject->getResult();
           
            if( !empty($arr_videos) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto los videos correctamente',
                    'data'      => $arr_videos );
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


    public function IngresarUnidadesAction( Request $request  ){
        
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
            //if( !$suscripcion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra suscripcion' ); }

            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();
                $ext                = $imagen->guessExtension();
                $file_name          = time().".".$ext;
                $imagen->move("uploads/unidades", $file_name);
    
                //grabo en bd la nueva unidad creada
                $unidades = new Unidades();
                $unidades->setNombre( $nombre );
                $unidades->setDescripcion( $descripcion );
                $unidades->setUsrSuscripcion( $suscripcion );
                $unidades->setUrl( $file_name );
                $fechaIngreso    = new \DateTime("now");
                $unidades->setFechaDeCreacion( $fechaIngreso );
   
                $em->persist( $unidades );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la unidad correctamente',
                    'data'      => $unidades  );
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

    public function IngresarCapitulosAction( Request $request  ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $unidad             = $request->get( 'unidad', null );
        $descripcion        = $request->get( 'descripcion', null );
        $imagen             = $request->files->get( 'imagen', null );
        $suscripcion        = $request->get( 'suscripcion', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token, null );

        if( $authCheck ){
            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$descripcion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra descripcion' ); }
            if( !$unidad ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra unidad' ); }
            if( !$imagen ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra imagen' ); }


            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();
                $ext                = $imagen->guessExtension();
                $file_name          = time().".".$ext;
                $imagen->move("uploads/capitulos", $file_name);
    
                //grabo en bd la nueva unidad creada
                $capitulos = new Capitulos();
                $capitulos->setNombre( $nombre );
                $capitulos->setDescripcion( $descripcion );
                $capitulos->setUrl( $file_name );
                $capitulos->setIdUnidades( $unidad );
                $capitulos->setUsrSuscripcion( $suscripcion );
                $fechaIngreso    = new \DateTime("now");
                $capitulos->setFechaDeCreacion( $fechaIngreso );
    
                $em->persist( $capitulos );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la unidad correctamente',
                    'data'      => $capitulos  );
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


    public function IngresarVideosAction( Request $request  ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $descripcion        = $request->get( 'descripcion', null );
        $unidad             = $request->get( 'unidad', null );
        $capitulo           = $request->get( 'capitulo', null );
        //$imagen             = $request->files->get( 'imagen', null );
        //$material           = $request->files->get( 'material', null );
        $url                = $request->get( 'url', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $suscripcion        = $request->get( 'suscripcion', null );


        if( $authCheck ){

            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$descripcion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra descripcion' ); }
            if( !$unidad ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra unidad' ); }
            if( !$capitulo ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra capitulo' ); }
            if( !$url ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra url' ); }
            //if( !$imagen ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra imagen' ); }

            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();
                //dump($imagen); die();
                //$ext                = $imagen->guessExtension();
                //$file_nameImg       = time().".".$ext;
                //$imagen->move("uploads/videos", $file_nameImg);
    
                //dump('pasa'); die();

                /*if( $material != null ){
                    $ext                = $material->guessExtension();
                    $file_nameMat       = time().".".$ext;
                    $material->move("uploads/material", $file_nameMat);

                    //grabo material asociado al video
                    $mate = new Material();
                    $mate->setUrl( $file_nameMat );

                    $em->persist( $mate );
                    $em->flush();
                    //obtengo ID


                }else{
                    $file_nameMat = null;
                }*/

                //grabo en bd la nueva unidad creada
                $videos = new Videos();
                $videos->setNombre( $nombre );
                $videos->setDescripcion( $descripcion );
                $videos->setUrl( $url );
                $videos->setIdUnidad( $unidad );
                //$videos->setUrlImagen( $file_nameImg );
                $videos->setIdCapitulo( $capitulo );
                $videos->setUsrSuscripcion( $suscripcion );
                //grabo ID de material si esque solo hay 1 material por video sino grabo en material 
                // lo nuevo y asocio id de video
                /*if($file_nameMat != null){
                    //grabo el ultimo id ingresado en el material de apoyo
                    $videos->setIdMaterial( $mate->getId() );
                }else{
                    $videos->setIdMaterial( 0 );
                }*/

                $fechaIngreso = new \DateTime("now");

                //dump( $fechaIngreso ); die();

                $videos->setFechaDeRegistro( $fechaIngreso );



                //dump( $videos ); die();
                $em->persist( $videos );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la unidad correctamente',
                    'data'      => $videos  );
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
}