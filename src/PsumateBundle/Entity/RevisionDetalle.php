<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RevisionDetalle
 *
 * @ORM\Table(name="revision_detalle")
 * @ORM\Entity
 */
class RevisionDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="revision_detalle_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_revision", type="integer", nullable=false)
     */
    private $idRevision;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_lista", type="integer", nullable=false)
     */
    private $idLista;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="respuestas", type="string", nullable=false)
     */
    private $respuestas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_suscripcion", type="integer", nullable=false)
     */
    private $usrSuscripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="sum_correctas", type="integer", nullable=false)
     */
    private $sumCorrectas;



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
     * Set idRevision
     *
     * @param integer $idRevision
     *
     * @return RevisionDetalle
     */
    public function setIdRevision($idRevision)
    {
        $this->idRevision = $idRevision;

        return $this;
    }

    /**
     * Get idRevision
     *
     * @return integer
     */
    public function getIdRevision()
    {
        return $this->idRevision;
    }

    /**
     * Set idLista
     *
     * @param integer $idLista
     *
     * @return RevisionDetalle
     */
    public function setIdLista($idLista)
    {
        $this->idLista = $idLista;

        return $this;
    }

    /**
     * Get idLista
     *
     * @return integer
     */
    public function getIdLista()
    {
        return $this->idLista;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return RevisionDetalle
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set respuestas
     *
     * @param string $respuestas
     *
     * @return RevisionDetalle
     */
    public function setRespuestas($respuestas)
    {
        $this->respuestas = $respuestas;

        return $this;
    }

    /**
     * Get respuestas
     *
     * @return string
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return RevisionDetalle
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set usrSuscripcion
     *
     * @param integer $usrSuscripcion
     *
     * @return RevisionDetalle
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
     * Set sumCorrectas
     *
     * @param integer $sumCorrectas
     *
     * @return RevisionDetalle
     */
    public function setSumCorrectas($sumCorrectas)
    {
        $this->sumCorrectas = $sumCorrectas;

        return $this;
    }

    /**
     * Get sumCorrectas
     *
     * @return integer
     */
    public function getSumCorrectas()
    {
        return $this->sumCorrectas;
    }
}
