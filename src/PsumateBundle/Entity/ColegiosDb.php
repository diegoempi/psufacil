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


}

