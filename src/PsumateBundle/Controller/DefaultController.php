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

use PsumateBundle\Entity\BecaForm;
use PsumateBundle\Entity\InformacionForm;

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

        $dql                = "SELECT a.id, a.nombre FROM PsumateBundle:ColegiosDb a WHERE a.codComuna = $comuna ORDER BY a.id ASC";
        $colegiosObject     = $em->createQuery($dql);
        $colegios           = $colegiosObject->getResult();

        if( $colegios ){
            
            return $GlobalFunctions->json( array(
                'code' => '200',
                'status' => 'success',
                'data'=> $colegios) );

        }else{
            
            return $GlobalFunctions->json( array(
                'code' => '200',
                'status' => 'success',
                'data'=> null) );

        }
		
    }

    public function obtenerRegionAction()
    {
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $arr_regiones       = array();
        $em                 = $this->getDoctrine()->getManager();      
        
        /*$regiones           = $em->getRepository("PsumateBundle:ColegiosDb")
                                ->findAll();*/

        $dql                = "SELECT a.codRegion FROM PsumateBundle:ColegiosDb a GROUP BY a.codRegion ORDER BY a.codRegion ASC";
        $regionesObject     = $em->createQuery($dql);
        $regiones           = $regionesObject->getResult();

        
        return $GlobalFunctions->json( array(
            'code' => '200',
            'status' => 'success',
            'data'=> $regiones) );

    }

    public function obtenerComunaAction( Request $request )
    {
        //recibe region para retornar comuna
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        $i                  = 1;
        $arr_comunas        = array();
        $region             = $request->get('region');
        $em                 = $this->getDoctrine()->getManager();
        
        //$comunas            = $em->getRepository("PsumateBundle:ColegiosDb")
        //                      ->findBy(array('codRegion' => $region ));

        $dql                = "SELECT a.codComuna, a.nomComuna FROM PsumateBundle:ColegiosDb a WHERE a.codRegion = $region GROUP BY a.codComuna, a.nomComuna ORDER BY a.codComuna ASC";
        $comunasObject      = $em->createQuery($dql);
        $comunas            = $comunasObject->getResult();

        foreach ($comunas as $value) {

            $arr_comunas[$i]['id']           = $value['codComuna'];
            $arr_comunas[$i]['nom_comuna']   = $value['nomComuna'];
            $i++;
        }

        return $GlobalFunctions->json( array(
            'code' => '200',
            'status' => 'success',
            'data'=> $arr_comunas) );

    }    

    public function ingBecaAction( Request $request )
    {
        //recibe data del formulario
        $GlobalFunctions        = $this->get(GlobalFunctions::class);
        $jsonRequest            = $request->get('data');
        $data                   = null;      

        if($jsonRequest){

            $params         = json_decode( $jsonRequest );
            $alNombres      = ( isset( $params->alNombres )) ? $params->alNombres : null;         
            $alApeMat       = ( isset( $params->alApeMat )) ? $params->alApeMat : null;
            $alApePat       = ( isset( $params->alApePat )) ? $params->alApePat : null;
            $alNacimiento   = ( isset( $params->alNacimiento )) ? $params->alNacimiento : null;
            $alEmail        = ( isset( $params->alEmail )) ? $params->alEmail : null;
            $alTelefono     = ( isset( $params->alTelefono )) ? $params->alTelefono : null;
            $alRut          = ( isset( $params->alRut )) ? $params->alRut : null;
            $alPais         = ( isset( $params->alPais )) ? $params->alPais : null;
            $alRegion       = ( isset( $params->alRegion )) ? $params->alRegion : null;
            $alComuna       = ( isset( $params->alComuna )) ? $params->alComuna : null;
            $alColegio      = ( isset( $params->alColegio )) ? $params->alColegio : null;
            $apNombres      = ( isset( $params->apNombres )) ? $params->apNombres : null;
            $apApeMat       = ( isset( $params->apApeMat )) ? $params->apApeMat : null;
            $apApePat       = ( isset( $params->apApePat )) ? $params->apApePat : null;
            $apEmail        = ( isset( $params->apEmail )) ? $params->apEmail : null;
            $apTelefono     = ( isset( $params->apTelefono )) ? $params->apTelefono : null;
            $razonesBeca    = ( isset( $params->razonesBeca )) ? $params->razonesBeca : null;

            if( !$alNombres ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alNombres' ); }
            if( !$alApeMat ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alApeMat' ); }
            if( !$alApePat ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alApePat' ); }
            if( !$alNacimiento ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alNacimiento' ); }
            if( !$alEmail ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alEmail' ); }
            if( !$alTelefono ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alTelefono' ); }
            if( !$alRut ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alRut' ); }
            //if( !$alPais ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alPais' ); }
            if( !$alRegion ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alRegion' ); }
            if( !$alComuna ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alComuna' ); }
            if( !$alColegio ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra alColegio' ); }
            if( !$apNombres ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra apNombres' ); }
            if( !$apApeMat ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra apApeMat' ); }
            if( !$apApePat ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra apApePat' ); }
            if( !$apEmail ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra apEmail' ); }
            if( !$apTelefono ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra apTelefono' ); }
            if( !$razonesBeca ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra razonesBeca' ); }

            //validacion de email
            $emailConstraint = new Assert\Email();

            $validateAlEmail = $this->get( "validator" )->validate( $alEmail, $emailConstraint );
            $validateApEmail = $this->get( "validator" )->validate( $apEmail, $emailConstraint );
            if(count( $validateAlEmail ) != 0) { $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'invalido alEmail' ); }
            if(count( $validateApEmail ) != 0) { $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'invalido apEmail' ); }

            if( !$data ){

                $em   = $this->getDoctrine()->getManager();

                $beca = new BecaForm();
                $beca->setAlnombres( $alNombres );
                $beca->setAlapemat( $alApeMat );
                $beca->setAlapepat( $alApePat );
                                
                $alNacimiento =  \DateTime::createFromFormat('d-m-Y', $alNacimiento);

                $beca->setAlnacimiento( $alNacimiento );
                $beca->setAlemail( $alEmail );
                $beca->setAltelefono( $alTelefono );
                $beca->setAlrut( $alRut );
                $beca->setAlregion( $alRegion );
                $beca->setAlcomuna( $alComuna );
                $beca->setAlcolegio( $alColegio );
                $beca->setApnombres( $apNombres );
                $beca->setApapemat( $apApeMat );
                $beca->setApapepat( $apApePat );
                $beca->setApemail( $apEmail );
                $beca->setAptelefono( $apTelefono );
                $beca->setRazonesbeca( $razonesBeca );
               
                $em->persist( $beca );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'Success' 
                );   
            }

        }else{

            $data = array(
                'code'      => '200',
                'status'    => 'Error',
                'data'      => 'Debes enviar json via POST'
            );  

        }

        return $GlobalFunctions->json( $data );

    }    

    

    public function ingInfoAction( Request $request )
    {
        //recibe data del formulario
        $GlobalFunctions        = $this->get(GlobalFunctions::class);
        $jsonRequest            = $request->get('data');
        $data                   = null;
 
        if($jsonRequest){
 
            $params            = json_decode( $jsonRequest );
            $nombre            = ( isset( $params->nombre )) ? $params->nombre : null;         
            $email             = ( isset( $params->email )) ? $params->email : null;
            $telefono          = ( isset( $params->telefono )) ? $params->telefono : null;
            $mensaje           = ( isset( $params->mensaje )) ? $params->mensaje : null;

            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra nombre' ); }
            if( !$email ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra email' ); }
            if( !$telefono ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra telefono' ); }
            if( !$mensaje ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra mensaje' ); }
 
            //validacion de email
            $emailConstraint = new Assert\Email();
 
            $validateAlEmail = $this->get( "validator" )->validate( $email, $emailConstraint );
            if(count( $validateAlEmail ) != 0) { $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'invalido email' ); }
 
            if( !$data ){
 
                $em   = $this->getDoctrine()->getManager();

                $info = new InformacionForm();
                $info->setNombre( $nombre );
                $info->setEmail( $email );
                $info->setTelefono( $telefono );
                $info->setMensaje( $mensaje );
               
                $fechaActual = new \DateTime("now");

                $info->setFecha( $fechaActual );
                            
                $em->persist( $info );
                $em->flush();

                $data = array(
                    'code'      => '200',
                    'status'    => 'Success' 
                );   
            }
 
        }else{

            $data = array(
                'code'      => '200',
                'status'    => 'Error',
                'data'      => 'Debes enviar json via POST'
            );  
        }

        return $GlobalFunctions->json( $data );
    }
}