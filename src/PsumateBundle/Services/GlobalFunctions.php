<?php
namespace PsumateBundle\Services;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class GlobalFunctions
{

    public function __construct() 
    {
	 
	}
    
    public function classToJson($rows)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $rows = $serializer->normalize($rows, 'json');
        return $rows;
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