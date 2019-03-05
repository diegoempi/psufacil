<?php 

namespace PsumateBundle\Services;
use Firebase\JWT\JWT;

class JwtAuth{
    
    public $manager;
    public $key;

    public function __construct( $manager ) 
    {
        $this->manager = $manager;
        $this->key = "holaquetalsoylaclavesecreta12_++34567";
	}
    
    public function signup( $rut, $password, $getIdentity, $dv){

        //busco data en BD postgresql por entity manager
        $user = $this->manager->getRepository('PsumateBundle:Usuarios')->findOneBy(array(
            "rut" => $rut,
            "password" => $password,
            "dv" => $dv
        ));

        //declaro var en false
        $signup = false;
        
        //verifico si viene data de la base //correcto asigno true a var signup
        if( is_object( $user )){
            $signup = true;
        }

        if( $signup == true ){
            //GENERaR TOKEN JWT
            $token = array(
                "sub" => $user->getId(),
                "email" => $user->getEmail(),
                "name" => $user->getNombre(),
                "surname" => $user->getApellido(),
                "activo" => $user->getActivo(),
                "role" => $user->getRole(),
                "iat" => time(),
                "exp" => time() + (7 * 24 * 60 * 60),
                'status' => true
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode( $jwt, $this->key, array('HS256'));

            if( $getIdentity == null ){
                $data = $jwt;
            }else{
                $data = $decoded;
            }

        }else{
            //$data = null;
            $data = array(
                'code' => '200',
                'status' => null,
                'data'=> 'Rut o Contraseña incorrecta'
            );
        }

        return $data;
    }

    public function checkToken( $jwt, $getIdentity = false){

        $auth = false;

        try{
            $decoded = JWT::decode( $jwt, $this->key, array("HS256"));
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if( isset($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if( $getIdentity == false ){
            return $auth;
        }else{
            return $decoded;
        }

    }

}