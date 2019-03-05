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
        $dv                 = ( isset( $params->digito_verificador )) ? $params->digito_verificador : null;
        $getIdentity        = ( isset( $params->getIdentity )) ? $params->getIdentity : null;

        //cifrar contraseña
        $pwd = hash('sha256', $password);

        if( $rut != null && $password != null && $dv != null ){

            $rut = str_replace( '.','', $rut );
            $dv  = strtoupper($dv);

            
            $jwt_auth   = $this->get(JwtAuth::class);
            $signup     = $jwt_auth->signup($rut, $pwd,$getIdentity,$dv);

            return $this->json($signup);

        }else{
            $user =  $GlobalFunctions->json( array(
                'code' => '200',
                'status' => null,
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

        //dump( $json ); die();

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
            
            //RUT
            $rut                        = ( isset( $params->rut )) ? $params->rut : null;
            $dv                         = ( isset( $params->digito_verificador )) ? $params->digito_verificador : null;
            
            $dv                         = strtoupper($dv);
            $rut                        = str_replace( '.','', $rut );
            $rut                        = $rut.'-'.$dv;
            $rut_valido                 = valida_rut($rut);

           

            $telefono                   = ( isset( $params->telefono )) ? $params->telefono : null;

            $nombreApoderado            = ( isset( $params->nombreApoderado )) ? $params->nombreApoderado : null;
            $apellidosApoderado         = ( isset( $params->apellidosApoderado )) ? $params->apellidosApoderado : null;
            $emailApoderado             = ( isset( $params->emailApoderado )) ? $params->emailApoderado : null;
            $telefonoApoderado          = ( isset( $params->telefonoApoderado )) ? $params->telefonoApoderado : null;
            
            
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
            if( !$telefono ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra telefono' ); }            

            
            if( !$nombreApoderado ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra nombreApoderado' ); }
            if( !$apellidosApoderado ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra apellidosApoderado' ); }
            if( !$emailApoderado ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra emailApoderado' ); }
            if( !$telefonoApoderado ){ $data = array( 'code'=> '200' ,'status' => 'error', 'msg' => 'no se encuentra telefonoApoderado' ); }




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

            //dump( $data );
            //die();

            if( !$data ){

                $user = new Usuarios();
                $user->setNombre( $nombre );
                $user->setApellido( $apellido );

                //quito el guion y el dv
                $pos = strpos($rut , '-');
                if ($pos !== false)
                $rut = substr($rut, 0, $pos);

                $user->setRut( $rut );
                $user->setDv( $dv );
                $user->setCodigoPsu( $codigo_psu );
                $user->setRole( $role );
                $user->setEmail( $email );
                $user->setRegion( $region );
                $user->setComuna( $comuna );
                $user->setColegio( $colegio );
                $user->setFechaDeNacimiento( $fecha_de_nacimiento );
                $user->setTelefono( $telefono );

                $fechaIngreso    = new \DateTime("now");
                $expiracion     = new \DateTime("now");
                $expiracion->modify('+1 year');

                $user->setFechaDeCreacion( $fechaIngreso );
                $user->setExpiracion( $expiracion );
                
                //apoderado
                $user->setNombreApoderado( $nombreApoderado );
                $user->setApellidosApoderado( $apellidosApoderado );
                $user->setEmailApoderado( $emailApoderado );
                $user->setTelefonoApoderado( $telefonoApoderado );

                $user->setActivo( 0 );

                //$user->setFechaDeNacimiento( $fecha_de_nacimiento );
                //$user->setFechaDeNacimiento( $fecha_de_nacimiento );
                //$user->setFechaDeNacimiento( $fecha_de_nacimiento );
                //$user->setFechaDeNacimiento( $fecha_de_nacimiento );


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

function obtenerDigito($_rol){
    $factor = 2;
    $suma = 0; 
    $_rol = $_rol . "";
    
    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
        
    $dv = 11 - $suma % 11;
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
    $rut = $_rol.$dv;
    
    //dump($rut); exit;
    
    return number_format( substr ( $rut, strlen($rut) -1 , 1 ) );
        /* Bonus: remuevo los ceros del comienzo. */
       /* while($_rol[0] == "0") {
            $_rol = substr($_rol, 1);
        }
        $factor = 2;
        $suma = 0;
        for($i = strlen($_rol) - 1; $i >= 0; $i--) {
            $suma += $factor * $_rol[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        /*$dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        return $dv;
*/
}

function valida_rut($rut)
{
    $rutC = preg_replace('/[^k0-9]/i', '', $rut);
    $dv  = substr($rutC, -1);
    $numero = substr($rutC, 0, strlen($rutC)-1);
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

        /*$dvt = substr($trut, strlen($trut) - 1, strlen($trut));
        $rutt = substr($trut, 0, strlen($trut) - 1);
        $rut = (($rutt) + 0);
        $pa = $rut;
        $c = 2;
        $sum = 0;
        while ($rut > 0)
        {
            $a1 = $rut % 10;
            $rut = floor($rut / 10);
            $sum = $sum + ($a1 * $c);
            $c = $c + 1;
            if ($c == 8)
            {
                $c = 2;
            }
        }
        $di = $sum % 11;
        $digi = 11 - $di;
        $digi1 = ((string )($digi));
        if (($digi1 == '10'))
        {
            $digi1 = 'K';
        }
        if (($digi1 == '11'))
        {
            $digi1 = '0';
        }
        if (($dvt == $digi1))
        {
            echo 'El rut es valido: ', $pa, '-', $digi1;
        } else
        {
            echo 'El rut ingresado ', $pa, '-', $dvt, ' es invalido. Se esperaba: ', $pa,
                '-', $digi1;
        }*/
        }
