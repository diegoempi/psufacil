<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RevisionUnidad
 *
 * @ORM\Table(name="revision_unidad")
 * @ORM\Entity
 */
class RevisionUnidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="revision_unidad_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", nullable=false)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_suscripcion", type="integer", nullable=false)
     */
    private $usrSuscripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_creacion", type="datetime", nullable=false)
     */
    private $fechaDeCreacion;



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
     * @return RevisionUnidad
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return RevisionUnidad
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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return RevisionUnidad
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set usrSuscripcion
     *
     * @param integer $usrSuscripcion
     *
     * @return RevisionUnidad
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

    /**
     * Set fechaDeCreacion
     *
     * @param \DateTime $fechaDeCreacion
     *
     * @return RevisionUnidad
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
}
