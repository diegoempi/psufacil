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

class RevisionController extends Controller
{

    public function ObtenerRevisionAction( Request $request ){

        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $capitulo           = $request->get( 'capitulo', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $identity           = $jwt_auth->checkToken( $token, true );
        $arr_revision       = array();

        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.nombre, a.descripcion, a.imagen 
                                FROM PsumateBundle:RevisionUnidad a 
                                WHERE a.usrSuscripcion = $identity->usr_suscripcion
                                GROUP BY a.id 
                                ORDER BY a.id 
                                DESC";
            $revisionObject  = $em->createQuery($dql);
            $arr_revision    = $revisionObject->getResult();

            if( !empty($arr_revision) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto las revisiones correctamente',
                    'data'      => $arr_revision );
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'No se encuentran revisiones disponibles',
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

    public function ObtenerListaRevisionAction( Request $request ){

        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $revision           = $request->get( 'revision', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $identity           = $jwt_auth->checkToken( $token, true );
        $arr_revisionLista  = array();

        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.idUnidad ,a.nombre
                                FROM PsumateBundle:RevisionLista a 
                                WHERE a.idUnidad = $revision 
                                AND a.usrSuscripcion = $identity->usr_suscripcion 
                                GROUP BY a.id 
                                ORDER BY a.id 
                                DESC";
            $revisionObject  = $em->createQuery($dql);
            $arr_revisionLista    = $revisionObject->getResult();


            //dump( $arr_revisionLista ); die();



            if( !empty($arr_revisionLista) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto las revisiones correctamente',
                    'data'      => $arr_revisionLista );
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'No se encuentran revisiones disponibles',
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

    public function ObtenerDetalleRevisionAction( Request $request ){

        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $unidad             = $request->get( 'revision', null );
        $lista              = $request->get( 'lista', null );
        $identity           = $jwt_auth->checkToken( $token, true );        
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arrRevisionDetalle = array();

        if( $authCheck ){

            if( $unidad != ''  &&  $lista != ''){

                //obtengo id de usuario
                $identity        = $jwt_auth->checkToken( $token, true );               
                $em              = $this->getDoctrine()->getManager();
             
                //obtener ensayo con los parametros revision y lista
                $dql             = "SELECT a.id, a.pregunta, a.respuestaCorrecta, '' as respuesta, 'false' as correcta
                                    FROM PsumateBundle:RevisionCorrectas a 
                                    WHERE a.idUnidad = $unidad 
                                    AND a.idLista = $lista 
                                    AND a.usrSuscripcion = $identity->usr_suscripcion 
                                    GROUP BY a.id 
                                    ORDER BY a.id 
                                    ASC";

                $revisionObject  = $em->createQuery($dql);
                $arrRevisionDetalle   = $revisionObject->getResult();           
             
        
                //obtengo respuestas
                $dqlRes          = "SELECT a.id, a.respuestas
                                    FROM PsumateBundle:RevisionDetalle a
                                    WHERE a.idRevision = $unidad 
                                    AND a.idLista = $lista 
                                    AND a.idUsuario = $identity->sub
                                    GROUP BY a.id 
                                    ORDER BY a.id 
                                    DESC";

               
                $revisionObjectRes  = $em->createQuery($dqlRes)->setMaxResults(1);
                $arrRevisionDetalleRes   = $revisionObjectRes->getResult();
                $countCorrectas = 0;

                if (!empty( $arrRevisionDetalle ) && is_array( $arrRevisionDetalle ) ) {

                    $i = 0;
                    foreach ($arrRevisionDetalle as $key => $value) {
                      //$value['alternativas'] = ['A','B'];
                      $arrRevisionDetalle[$i]['alternativas'] = ['A','B','C','D','E'];
                      $i++;
                    }


                    if (!empty( $arrRevisionDetalleRes ) && is_array( $arrRevisionDetalleRes ) ) {

                        $arrayRes = explode("|", $arrRevisionDetalleRes[0]['respuestas']);

                        $idx = 0;
                        
    
                        foreach ($arrRevisionDetalle as $key => $value) {
        
                            if($arrayRes[$idx]){
                                $arrRevisionDetalle[$idx]['respuesta'] = $arrayRes[$idx];

                                if( $arrRevisionDetalle[$idx]['respuesta'] != $arrRevisionDetalle[$idx]['respuestaCorrecta'] ){
                                    $arrRevisionDetalle[$idx]['correcta'] = false;
                                }else{
                                    $arrRevisionDetalle[$idx]['correcta'] = true;
                                    $countCorrectas = $countCorrectas + 1 ;
                                }

                            }else{
                                $arrRevisionDetalle[$idx]['correcta'] = false;
                            }


                            /*for ($i=0; $i <= 4; $i++) { 
                                
                                /*if( $i = 0){
                                    $arrRevisionDetalle[$idx]['alternativas'][$i] = 'A';

                                }else if( $i = 1){
                                    $arrRevisionDetalle[$idx]['alternativas'][$i] = 'B';
                                }else if( $i = 2){
                                    $arrRevisionDetalle[$idx]['alternativas'][$i] = 'C';
                                }else if( $i = 3){
                                    $arrRevisionDetalle[$idx]['alternativas'][$i] = 'D';
                                }else if( $i = 4){
                                    $arrRevisionDetalle[$idx]['alternativas'][$i] = 'E';
                                }*/

                                


                                //array_push($arrRevisionDetalle['alternativas'],'A','B','C','D','E');
                        /*}*/
                            /*if( $value['respuestaCorrecta'] ==  $arrayRes[$idx] ){ 
                                $arrRevisionDetalle[$idx]['correcta'] = 1;
                                $arrRevisionDetalle[$idx]['respuesta_user'] = $arrayRes[$idx];
                            }else if( $arrayRes[$idx] == ''){
                                $arrRevisionDetalle[$idx]['correcta'] = 2;
                                $arrRevisionDetalle[$idx]['respuesta_user'] = $arrayRes[$idx];
                            }else{
                                $arrRevisionDetalle[$idx]['correcta'] = 0;
                                $arrRevisionDetalle[$idx]['respuesta_user'] = $arrayRes[$idx];
                            }*/
        
                            $idx++;
                        }
                        
                        //dump( $arrRevisionDetalle );
                        //die();
                    }else{
                        //retorno solo preguntas
                        //foreach ($arrRevisionDetalle as $key => $value) {
                        //    $arrRevisionDetalle[0]['correcta'] = 2;
                        //    $arrRevisionDetalle[0]['respuesta_user'] = '';
                        //}
                       
                    }   


                }

                if( $countCorrectas == count($arrRevisionDetalle) ){
                    $completado = true;
                }else{
                    $completado = false;
                }

                //dump($countCorrectas); exit;

                if( !empty($arrRevisionDetalle) ){
                    $data = array(
                        'code'      => '200',
                        'status'    => 'success',
                        'msj'       => 'se han devuelto las revisiones correctamente',
                        'completado' => $completado,
                        'data'      => $arrRevisionDetalle );
                }else{
                    $data = array(
                        'code'      => '200',
                        'status'    => 'error',
                        'completado' => $completado,
                        'msj'       => 'No se encuentran revisiones disponibles',
                        'data'      => null );
                }

            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'url_invalida',
                    'msj'       => 'url invalida',
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


   
    public function IngresarRevisionUnidadAction( Request $request  ){
        
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
                $imagen->move("uploads/revision/unidades", $file_name);

                //grabo en bd la nueva unidad creada
                $unidad = new RevisionUnidad();
                $unidad->setNombre( $nombre );
                $unidad->setDescripcion( $descripcion );
                $unidad->setImagen( $file_name );
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


    public function ObtenerAdmRevisionListaAction( Request $request ){

        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_revisionLista  = array();


        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.nombre ,a.descripcion
                                FROM PsumateBundle:RevisionUnidad a 
                                GROUP BY a.id 
                                ORDER BY a.id 
                                DESC";
            $revisionObject  = $em->createQuery($dql);
            $arr_revisionLista    = $revisionObject->getResult();

            if( !empty($arr_revisionLista) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto las unidades de revision correctamente',
                    'data'      => $arr_revisionLista );
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'No se encuentran las unidades de revision disponibles',
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


    public function IngresarRevisionListaAction( Request $request  ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $unidad             = $request->get( 'unidad', null );
        $suscripcion        = $request->get( 'suscripcion', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token, null );


        if( $authCheck ){
            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$unidad ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra unidad' ); }

            if( !$data ){
                $em                 = $this->getDoctrine()->getManager();

                //grabo en bd la nueva unidad creada
                $lista = new RevisionLista();
                $lista->setNombre( $nombre );
                $lista->setIdUnidad( $unidad );
                $lista->setUsrSuscripcion( $suscripcion );
                $fechaIngreso    = new \DateTime("now");
                $lista->setFechaDeCreacion( $fechaIngreso );
      
                $em->persist( $lista );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la lista correctamente',
                    'data'      => $lista  );
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

    //PARA ADMINISTRADOR REVISION CMB LISTA
    public function ObtenerAdmRevisionListasAction( Request $request ){

        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $unidad             = $request->get( 'unidad', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_revisionLista  = array();



        //dump($unidad); die();

        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.nombre
                                FROM PsumateBundle:RevisionLista a 
                                WHERE a.idUnidad = $unidad
                                GROUP BY a.id 
                                ORDER BY a.id 
                                DESC";
            $revisionObject  = $em->createQuery($dql);
            $arr_revisionLista    = $revisionObject->getResult();

            if( !empty($arr_revisionLista) ){
                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se han devuelto las listas de revision correctamente',
                    'data'      => $arr_revisionLista );
            }else{
                $data = array(
                    'code'      => '200',
                    'status'    => 'error',
                    'msj'       => 'No se encuentran las listas de revision disponibles',
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


    public function IngresarRevisionAction( Request $request ){
          
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $authCheck          = $jwt_auth->checkToken( $token, null );

        //obtengo vars
        $unidad             = $request->get( 'unidad', null );
        $lista              = $request->get( 'lista', null );
        $alternativas       = $request->get( 'alternativas', null );
        $suscripcion        = $request->get( 'suscripcion', null );
        $posts              = json_decode($alternativas);

        if( $authCheck ){

            $em             = $this->getDoctrine()->getManager();

            $index          = 1;
            foreach ($posts as $key => $value) {
                
                
                $correctas = new RevisionCorrectas();
                $correctas->setIdUnidad( $unidad );
                $correctas->setIdLista( $lista );
                
                //set index
                $correctas->setPregunta( $index );
                $correctas->setRespuestaCorrecta( $value->correcta );


                $correctas->setUsrSuscripcion( $suscripcion );
                //fecha ingreso
                $fechaIngreso    = new \DateTime("now");
                $correctas->setFechaDeIngreso( $fechaIngreso );
    
                $em->persist( $correctas );
                $em->flush();
                $index++;
                }

                $data = array(
                    'code'      => '200',
                    'status'    => 'success',
                    'msj'       => 'se ha grabado la revision correctamente',
                    'data'      => null  );


        }else{
            $data = array(
                'code'      => '200',
                'status'    => 'error',
                'msj'       => 'Token invalido',
                'data'      => null );
        }

        return $GlobalFunctions->json( $data );      
    }


    public function IngresarRevisionAlumnoAction( Request $request ){
          
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $authCheck          = $jwt_auth->checkToken( $token, null );

        //obtengo vars
        $unidad             = $request->get( 'unidad', null );
        $lista              = $request->get( 'lista', null );
        $respuestas         = $request->get( 'respuestas', null );
        $suscripcion        = $request->get( 'usr_suscripcion', null );
        $usuario            = $request->get( 'id_usuario', null );
        
//        dump( $authCheck  );
//        dump( $respuestas  );
//        die();

        if( $authCheck ){

            $em             = $this->getDoctrine()->getManager();      
            $revision      = new RevisionDetalle();
            $revision->setIdRevision( $unidad );
            $revision->setIdLista( $lista );
                
            //set index
            $revision->setRespuestas( $respuestas );
            $revision->setUsrSuscripcion( $suscripcion );
            $revision->setIdUsuario( $usuario );
            //fecha ingreso
            $fechaIngreso    = new \DateTime("now");
            $revision->setFechaRegistro( $fechaIngreso );
    
            $em->persist( $revision );
            $em->flush();


            $data = array(
                'code'      => '200',
                'status'    => 'success',
                'msj'       => 'se ha grabado la revision correctamente',
                'data'      => null  );

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