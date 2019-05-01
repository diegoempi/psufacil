<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaterialCapitulo
 *
 * @ORM\Table(name="material_capitulo")
 * @ORM\Entity
 */
class MaterialCapitulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="material_capitulo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_unidades", type="integer", nullable=false)
     */
    private $idUnidades;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_creacion", type="datetime", nullable=false)
     */
    private $fechaDeCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

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
     * Set idUnidades
     *
     * @param integer $idUnidades
     *
     * @return MaterialCapitulo
     */
    public function setIdUnidades($idUnidades)
    {
        $this->idUnidades = $idUnidades;

        return $this;
    }

    /**
     * Get idUnidades
     *
     * @return integer
     */
    public function getIdUnidades()
    {
        return $this->idUnidades;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MaterialCapitulo
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
     * Set fechaDeCreacion
     *
     * @param \DateTime $fechaDeCreacion
     *
     * @return MaterialCapitulo
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return MaterialCapitulo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set usrSuscripcion
     *
     * @param integer $usrSuscripcion
     *
     * @return MaterialCapitulo
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
