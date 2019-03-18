<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videos
 *
 * @ORM\Table(name="videos")
 * @ORM\Entity
 */
class Videos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="videos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=200, nullable=false)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_registro", type="date", nullable=false)
     */
    private $fechaDeRegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_capitulo", type="integer", nullable=false)
     */
    private $idCapitulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_unidad", type="integer", nullable=false)
     */
    private $idUnidad;

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
     * @return Videos
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
     * @return Videos
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
     * Set url
     *
     * @param string $url
     *
     * @return Videos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set fechaDeRegistro
     *
     * @param \DateTime $fechaDeRegistro
     *
     * @return Videos
     */
    public function setFechaDeRegistro($fechaDeRegistro)
    {
        $this->fechaDeRegistro = $fechaDeRegistro;

        return $this;
    }

    /**
     * Get fechaDeRegistro
     *
     * @return \DateTime
     */
    public function getFechaDeRegistro()
    {
        return $this->fechaDeRegistro;
    }

    /**
     * Set idCapitulo
     *
     * @param integer $idCapitulo
     *
     * @return Videos
     */
    public function setIdCapitulo($idCapitulo)
    {
        $this->idCapitulo = $idCapitulo;

        return $this;
    }

    /**
     * Get idCapitulo
     *
     * @return integer
     */
    public function getIdCapitulo()
    {
        return $this->idCapitulo;
    }

    /**
     * Set idUnidad
     *
     * @param integer $idUnidad
     *
     * @return Videos
     */
    public function setIdUnidad($idUnidad)
    {
        $this->idUnidad = $idUnidad;

        return $this;
    }

    /**
     * Get idUnidad
     *
     * @return integer
     */
    public function getIdUnidad()
    {
        return $this->idUnidad;
    }

    /**
     * Set usrSuscripcion
     *
     * @param integer $usrSuscripcion
     *
     * @return Videos
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
