<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuarios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=56, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=56, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=56, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="region", type="integer", nullable=false)
     */
    private $region;

    /**
     * @var integer
     *
     * @ORM\Column(name="comuna", type="integer", nullable=false)
     */
    private $comuna;

    /**
     * @var integer
     *
     * @ORM\Column(name="colegio", type="integer", nullable=false)
     */
    private $colegio;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_de_nacimiento", type="string", length=255, nullable=false)
     */
    private $fechaDeNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_psu", type="string", length=255, nullable=true)
     */
    private $codigoPsu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_creacion", type="datetime", nullable=false)
     */
    private $fechaDeCreacion = 'now';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="rut", type="integer", nullable=false)
     */
    private $rut;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=20, nullable=false)
     */
    private $role;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiracion", type="datetime", nullable=false)
     */
    private $expiracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="activo", type="integer", nullable=false)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_apoderado", type="string", length=250, nullable=false)
     */
    private $nombreApoderado;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos_apoderado", type="string", length=250, nullable=false)
     */
    private $apellidosApoderado;

    /**
     * @var string
     *
     * @ORM\Column(name="email_apoderado", type="string", length=250, nullable=false)
     */
    private $emailApoderado;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_apoderado", type="string", length=15, nullable=false)
     */
    private $telefonoApoderado;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="dv", type="string", nullable=false)
     */
    private $dv;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_suscripcion", type="integer", nullable=false)
     */
    private $usrSuscripcion;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuarios
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Usuarios
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set region
     *
     * @param integer $region
     *
     * @return Usuarios
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return integer
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set comuna
     *
     * @param integer $comuna
     *
     * @return Usuarios
     */
    public function setComuna($comuna)
    {
        $this->comuna = $comuna;

        return $this;
    }

    /**
     * Get comuna
     *
     * @return integer
     */
    public function getComuna()
    {
        return $this->comuna;
    }

    /**
     * Set colegio
     *
     * @param integer $colegio
     *
     * @return Usuarios
     */
    public function setColegio($colegio)
    {
        $this->colegio = $colegio;

        return $this;
    }

    /**
     * Get colegio
     *
     * @return integer
     */
    public function getColegio()
    {
        return $this->colegio;
    }

    /**
     * Set fechaDeNacimiento
     *
     * @param string $fechaDeNacimiento
     *
     * @return Usuarios
     */
    public function setFechaDeNacimiento($fechaDeNacimiento)
    {
        $this->fechaDeNacimiento = $fechaDeNacimiento;

        return $this;
    }

    /**
     * Get fechaDeNacimiento
     *
     * @return string
     */
    public function getFechaDeNacimiento()
    {
        return $this->fechaDeNacimiento;
    }

    /**
     * Set codigoPsu
     *
     * @param string $codigoPsu
     *
     * @return Usuarios
     */
    public function setCodigoPsu($codigoPsu)
    {
        $this->codigoPsu = $codigoPsu;

        return $this;
    }

    /**
     * Get codigoPsu
     *
     * @return string
     */
    public function getCodigoPsu()
    {
        return $this->codigoPsu;
    }

    /**
     * Set fechaDeCreacion
     *
     * @param \DateTime $fechaDeCreacion
     *
     * @return Usuarios
     */
    public function setFechaDeCreacion($fechaDeCreacion)
    {
        $this->fechaDeCreacion = $fechaDeCreacion;

        return $this;
    }

    /**
     * Get fechaDeCreacion
     *
     * @return \DateTime
     */
    public function getFechaDeCreacion()
    {
        return $this->fechaDeCreacion;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set rut
     *
     * @param integer $rut
     *
     * @return Usuarios
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return integer
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Usuarios
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set expiracion
     *
     * @param \DateTime $expiracion
     *
     * @return Usuarios
     */
    public function setExpiracion($expiracion)
    {
        $this->expiracion = $expiracion;

        return $this;
    }

    /**
     * Get expiracion
     *
     * @return \DateTime
     */
    public function getExpiracion()
    {
        return $this->expiracion;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Usuarios
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set nombreApoderado
     *
     * @param string $nombreApoderado
     *
     * @return Usuarios
     */
    public function setNombreApoderado($nombreApoderado)
    {
        $this->nombreApoderado = $nombreApoderado;

        return $this;
    }

    /**
     * Get nombreApoderado
     *
     * @return string
     */
    public function getNombreApoderado()
    {
        return $this->nombreApoderado;
    }

    /**
     * Set apellidosApoderado
     *
     * @param string $apellidosApoderado
     *
     * @return Usuarios
     */
    public function setApellidosApoderado($apellidosApoderado)
    {
        $this->apellidosApoderado = $apellidosApoderado;

        return $this;
    }

    /**
     * Get apellidosApoderado
     *
     * @return string
     */
    public function getApellidosApoderado()
    {
        return $this->apellidosApoderado;
    }

    /**
     * Set emailApoderado
     *
     * @param string $emailApoderado
     *
     * @return Usuarios
     */
    public function setEmailApoderado($emailApoderado)
    {
        $this->emailApoderado = $emailApoderado;

        return $this;
    }

    /**
     * Get emailApoderado
     *
     * @return string
     */
    public function getEmailApoderado()
    {
        return $this->emailApoderado;
    }

    /**
     * Set telefonoApoderado
     *
     * @param string $telefonoApoderado
     *
     * @return Usuarios
     */
    public function setTelefonoApoderado($telefonoApoderado)
    {
        $this->telefonoApoderado = $telefonoApoderado;

        return $this;
    }

    /**
     * Get telefonoApoderado
     *
     * @return string
     */
    public function getTelefonoApoderado()
    {
        return $this->telefonoApoderado;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Usuarios
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set dv
     *
     * @param string $dv
     *
     * @return Usuarios
     */
    public function setDv($dv)
    {
        $this->dv = $dv;

        return $this;
    }

    /**
     * Get dv
     *
     * @return string
     */
    public function getDv()
    {
        return $this->dv;
    }

    /**
     * Set usrSuscripcion
     *
     * @param integer $usrSuscripcion
     *
     * @return Usuarios
     */
    public function setUsrSuscripcion($usrSuscripcion)
    {
        $this->usrSuscripcion = $usrSuscripcion;

        return $this;
    }

    /**
     * Get usrSuscripcion
     *
     * @return integer
     */
    public function getUsrSuscripcion()
    {
        return $this->usrSuscripcion;
    }
}
