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

class UserController extends Controller
{
    public function loginAction( Request $request )
    {
        $GlobalFunctions    = $this->get(GlobalFunctions::class);
        
        $json               = $request->get('json',null);
        $params             = json_decode( $json );
        $user               = '';

        //dump( $json ); die();

        $rut                = ( isset( $params->rut )) ? $params->rut : null;
        $password           = ( isset( $params->password )) ? $params->password : null;
        $getIdentity        = ( isset( $params->getIdentity )) ? $params->getIdentity : null;

        //dump( $request ); die();

        //cifrar contraseña
        $pwd = hash('sha256', $password);

        if( $rut != null && $password != null){  
            
            $jwt_auth   = $this->get(JwtAuth::class);

            $signup     = $jwt_auth->signup($rut, $pwd,$getIdentity);

            //dump($signup);

            return $this->json($signup);

        }else{
            $user =  $GlobalFunctions->json( array(
                'code' => '200',
                'status' => false,
                'data'=> 'Rut o Contraseña incorrecta' ) );
        }


        return $user;       

    }

    public function registerAction(Request $request){

        $GlobalFunctions        = $this->get(GlobalFunctions::class);
        $json                   = $request->get('json',null);
        $params                 = json_decode( $json );
        $user                   = '';
        $data                   = null;

        if( $json != null){
         
            $role                       = "user";
            $nombre                     = ( isset( $params->nombre )) ? $params->nombre : null;
            $apellido                   = ( isset( $params->apellido )) ? $params->apellido : null;
            $email                      = ( isset( $params->email )) ? $params->email : null;
            $region                     = ( isset( $params->region )) ? $params->region : null;
            $comuna                     = ( isset( $params->comuna )) ? $params->comuna : null;
            $colegio                    = ( isset( $params->colegio )) ? $params->colegio : null;
            $fecha_de_nacimiento        = ( isset( $params->fecha_de_nacimiento )) ? $params->fecha_de_nacimiento : null;
            //$token                    = ( isset( $params->token )) ? $params->token : null;
            $codigo_psu                 = ( isset( $params->codigo_psu )) ? $params->codigo_psu : null;
            $fecha_de_creacion          = new \Datetime( "now" );
            $password                   = ( isset( $params->password )) ? $params->password : null;
            $rut                        = ( isset( $params->rut )) ? $params->rut : null;

            
            
            if( !$nombre ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombre' ); }
            if( !$apellido ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra apellido' ); }
            if( !$email ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra email' ); }
            if( !$region ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra region' ); }
            if( !$comuna ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra comuna' ); }
            if( !$colegio ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra colegio' ); }
            if( !$fecha_de_nacimiento ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra fecha_de_nacimiento' ); }
            //if( !$codigo_psu ){ $data = array( 'code'=> '200' ,'status' => 'Error', 'data' => 'no se encuentra codigo_psu' ); }
            if( !$fecha_de_creacion ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra fecha_de_creacion' ); }
            if( !$password ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra password' ); }
            
            //valido el rut chilensi
            $rut_valido = valida_rut($rut);
            if( !$rut_valido ){ 
                $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'rut invalido' ); 
            }else{
                //rut correcto
                $rut = str_replace(".", "", $rut );
                $mystring = $rut;
                
                $findme   = '-';
                $pos = strpos($mystring, $findme);
                if($pos != false){
                    $rut = substr($rut,0,$pos);
                }
            }

            $emailConstraint        = new Assert\Email();
            $emailConstraint->message = "This email is not valid !!";

            $validate_email = $this->get("validator")->validate( $email, $emailConstraint );
            if(count( $validate_email ) != 0) { $data = array( 'code'=> '200' ,'status' => 'Error', 'msg' => 'invalido email' ); }


            if( !$data ){

                $user = new Usuarios();
                $user->setNombre( $nombre );
                $user->setApellido( $apellido );
                $user->setRut( $rut );
                $user->setCodigoPsu( $codigo_psu );
                $user->setRole( $role );
                $user->setEmail( $email );
                $user->setRegion( $region );
                $user->setComuna( $comuna );
                $user->setColegio( $colegio );
                $user->setFechaDeNacimiento( $fecha_de_nacimiento );

                $fechaIngreso    = new \DateTime("now");
                $expiracion     = new \DateTime("now");
                $expiracion->modify('+1 year');


                $user->setFechaDeCreacion( $fechaIngreso );
                $user->setExpiracion( $expiracion );
                $user->setActivo( 1 );

                $pwd = hash('sha256', $password);
                $user->setPassword( $pwd );

                $em = $this->getDoctrine()->getManager();
                $isset_user = $em->getRepository( 'PsumateBundle:Usuarios')->findBy(array(
                    "rut" => $rut
                ));

                //dump( $user ); die();

                if( count($isset_user) == 0 ){
                    $em->persist( $user );
                    $em->flush();
                    
                    $data = array(
                        'status'    => 'success',
                        'code'      => 200,
                        'msg'       => 'New user created !!',
                        'user'      => $user
                    );

                }else{
                    $data = array(
                        'status' => 'error',
                        'code' => 400,
                        'msg' => 'Rut del usuario duplicado!!'
                    );
                }

            }

        }else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'msg' => 'Usuario no creado!!'
            );
        }

        return $GlobalFunctions->json( $data );

    }


}    

function valida_rut($rut)
{
    $rut = preg_replace('/[^k0-9]/i', '', $rut);
    $dv  = substr($rut, -1);
    $numero = substr($rut, 0, strlen($rut)-1);
    $i = 2;
    $suma = 0;
    foreach(array_reverse(str_split($numero)) as $v)
    {
        if($i==8)
            $i = 2;
        $suma += $v * $i;
        ++$i;
    }
    $dvr = 11 - ($suma % 11);
    
    if($dvr == 11)
        $dvr = 0;
    if($dvr == 10)
        $dvr = 'K';
    if($dvr == strtoupper($dv))
        return true;
    else
        return false;
}