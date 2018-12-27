<?php
namespace PsumateBundle\Services;

class GlobalFunctions
{

    public function __construct( $manager ) 
    {
		$this->manager = $manager;
	}
    
    public function json( $data )
    {
		
        $normalizers    = array( new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());
        $encoders       = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());
        $serializer     = new \Symfony\Component\Serializer\Serializer( $normalizers, $encoders );
		$json = $serializer->serialize($data, 'json');
		

 
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->setContent( $json );
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function esRut($r = false, $format = null){
		if((!$r) or (is_array($r)))
			return false; /* Hace falta el rut */
	 
		if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
			return false; /* Era código basura */
	 
		if(!((strlen($r) == 8) or (strlen($r) == 9)))
			return false; /* La cantidad de carácteres no es válida. */
	 
		$v = strtoupper(substr($r, -1));
		if(!$r = substr($r, 0, -1))
			return false;
	 
		if(!((int)$r > 0))
			return false; /* No es un valor numérico */
	 
		$x = 2; $s = 0;
		for($i = (strlen($r) - 1); $i >= 0; $i--){
			if($x > 7)
				$x = 2;
			$s += ($r[$i] * $x);
			$x++;
		}
		$dv=11-($s % 11);
		if($dv == 10)
			$dv = 'K';
		if($dv == 11)
			$dv = '0';
		if($dv == $v){
			switch($format){
				case 'rut':
					return $r;
				break;
				case 'rut-dv':
					return $r.'-'.$v;
				break;
				case 'dv':
					return $v;
				break;
				default:
					return number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
				break;
			}
			
		}
		return false;
	}
}