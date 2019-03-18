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

class RevisionController extends Controller
{

    public function ObtenerRevisionAction( Request $request ){

        $GlobalFunctions    = $this->get( GlobalFunctions::class );
        $jwt_auth           = $this->get( JwtAuth::class );
        $token              = $request->get( 'authorization', null );
        $capitulo           = $request->get( 'capitulo', null );
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arr_revision       = array();

        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.nombre, a.descripcion, a.imagen 
                                FROM PsumateBundle:Revision a 
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
        $arr_revisionLista  = array();

        if( $authCheck ){

            $em              = $this->getDoctrine()->getManager();
            $dql             = "SELECT a.id, a.idRevision ,a.descripcion
                                FROM PsumateBundle:RevisionLista a 
                                WHERE a.idRevision = $revision 
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
        $revision           = $request->get( 'revision', null );
        $lista              = $request->get( 'lista', null );
        
        $authCheck          = $jwt_auth->checkToken( $token, null );
        $arrRevisionDetalle = array();


        if( $authCheck ){

            if( $revision != ''  &&  $lista != ''){

                //obtengo id de usuario
                $identity        = $jwt_auth->checkToken( $token, true );

               
                $em              = $this->getDoctrine()->getManager();
                
                //obtener ensayo con los parametros revision y lista
                $dql             = "SELECT a.id, a.pregunta, a.respuestaCorrecta 
                                    FROM PsumateBundle:RevisionCorrectas a 
                                    WHERE a.idRevision = $revision 
                                    AND a.idLista = $lista 
                                    GROUP BY a.id 
                                    ORDER BY a.id 
                                    ASC";

                $revisionObject  = $em->createQuery($dql);
                $arrRevisionDetalle   = $revisionObject->getResult();           
                    
                $dqlRes          = "SELECT a.id, a.respuestas
                                    FROM PsumateBundle:RevisionDetalle a
                                    WHERE a.idRevision = $revision 
                                    AND a.idLista = $lista 
                                    AND a.idUsuario = $identity->sub
                                    GROUP BY a.id 
                                    ORDER BY a.id 
                                    DESC";

               
                $revisionObjectRes  = $em->createQuery($dqlRes);
                $arrRevisionDetalleRes   = $revisionObjectRes->getResult();

                //dump($arrRevisionDetalleRes); die();

                if (!empty( $arrRevisionDetalleRes ) && is_array( $arrRevisionDetalleRes ) ) {
                //if(count($arrRevisionDetalleRes) == '0'){
                    $arrayRes = explode("|", $arrRevisionDetalleRes[0]['respuestas']);

                    $idx = 0;

                    foreach ($arrRevisionDetalle as $key => $value) {
    
                        if( $value['respuestaCorrecta'] ==  $arrayRes[$idx] ){ 
                            $arrRevisionDetalle[$idx]['correcta'] = 1;
                            $arrRevisionDetalle[$idx]['respuesta_user'] = $arrayRes[$idx];
                        }else if( $arrayRes[$idx] == ''){
                            $arrRevisionDetalle[$idx]['correcta'] = 2;
                            $arrRevisionDetalle[$idx]['respuesta_user'] = $arrayRes[$idx];
                        }else{
                            $arrRevisionDetalle[$idx]['correcta'] = 0;
                            $arrRevisionDetalle[$idx]['respuesta_user'] = $arrayRes[$idx];
                        }
    
                        $idx++;
                    }
                }else{
                    $arrRevisionDetalle[0]['correcta'] = 2;
                    $arrRevisionDetalle[0]['respuesta_user'] = '';
                }

                if( !empty($arrRevisionDetalle) ){
                    $data = array(
                        'code'      => '200',
                        'status'    => 'success',
                        'msj'       => 'se han devuelto las revisiones correctamente',
                        'data'      => $arrRevisionDetalle );
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


   
    public function IngresarCapitulosAction( Request $request  ){
        
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $jwt_auth           = $this->get( JwtAuth::class);
        $token              = $request->get( 'authorization', null ); 
        $nombre             = $request->get( 'nombre', null );
        $unidad             = $request->get( 'unidad', null );
        $descripcion        = $request->get( 'descripcion', null );
        $imagen             = $request->files->get( 'imagen', null );
        $data               = null;        
        $authCheck          = $jwt_auth->checkToken( $token );

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


    
}