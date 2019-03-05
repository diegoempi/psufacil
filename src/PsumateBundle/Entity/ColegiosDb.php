<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColegiosDb
 *
 * @ORM\Table(name="colegios_db")
 * @ORM\Entity
 */
class ColegiosDb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="colegios_db_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="rut_sostenedor", type="integer", nullable=true)
     */
    private $rutSostenedor;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_region", type="integer", nullable=false)
     */
    private $codRegion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_comuna", type="integer", nullable=false)
     */
    private $codComuna;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_comuna", type="string", length=250, nullable=false)
     */
    private $nomComuna;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_provincia", type="integer", nullable=false)
     */
    private $codProvincia;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_provincia", type="string", length=250, nullable=false)
     */
    private $nomProvincia;

    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", nullable=true)
     */
    private $latitud;

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", nullable=true)
     */
    private $longitud;



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
     * @return ColegiosDb
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
     * Set rutSostenedor
     *
     * @param integer $rutSostenedor
     *
     * @return ColegiosDb
     */
    public function setRutSostenedor($rutSostenedor)
    {
        $this->rutSostenedor = $rutSostenedor;

        return $this;
    }

    /**
     * Get rutSostenedor
     *
     * @return integer
     */
    public function getRutSostenedor()
    {
        return $this->rutSostenedor;
    }

    /**
     * Set codRegion
     *
     * @param integer $codRegion
     *
     * @return ColegiosDb
     */
    public function setCodRegion($codRegion)
    {
        $this->codRegion = $codRegion;

        return $this;
    }

    /**
     * Get codRegion
     *
     * @return integer
     */
    public function getCodRegion()
    {
        return $this->codRegion;
    }

    /**
     * Set codComuna
     *
     * @param integer $codComuna
     *
     * @return ColegiosDb
     */
    public function setCodComuna($codComuna)
    {
        $this->codComuna = $codComuna;

        return $this;
    }

    /**
     * Get codComuna
     *
     * @return integer
     */
    public function getCodComuna()
    {
        return $this->codComuna;
    }

    /**
     * Set nomComuna
     *
     * @param string $nomComuna
     *
     * @return ColegiosDb
     */
    public function setNomComuna($nomComuna)
    {
        $this->nomComuna = $nomComuna;

        return $this;
    }

    /**
     * Get nomComuna
     *
     * @return string
     */
    public function getNomComuna()
    {
        return $this->nomComuna;
    }

    /**
     * Set codProvincia
     *
     * @param integer $codProvincia
     *
     * @return ColegiosDb
     */
    public function setCodProvincia($codProvincia)
    {
        $this->codProvincia = $codProvincia;

        return $this;
    }

    /**
     * Get codProvincia
     *
     * @return integer
     */
    public function getCodProvincia()
    {
        return $this->codProvincia;
    }

    /**
     * Set nomProvincia
     *
     * @param string $nomProvincia
     *
     * @return ColegiosDb
     */
    public function setNomProvincia($nomProvincia)
    {
        $this->nomProvincia = $nomProvincia;

        return $this;
    }

    /**
     * Get nomProvincia
     *
     * @return string
     */
    public function getNomProvincia()
    {
        return $this->nomProvincia;
    }

    /**
     * Set latitud
     *
     * @param string $latitud
     *
     * @return ColegiosDb
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return string
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     *
     * @return ColegiosDb
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return string
     */
    public function getLongitud()
    {
        return $this->longitud;
    }
}
