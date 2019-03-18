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
     * @ORM\Column(name="id_revision", type="integer", nullable=true)
     */
    private $idRevision;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_lista", type="integer", nullable=true)
     */
    private $idLista;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=true)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="respuestas", type="string", nullable=true)
     */
    private $respuestas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;



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
}
