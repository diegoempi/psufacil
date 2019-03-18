<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RevisionLista
 *
 * @ORM\Table(name="revision_lista")
 * @ORM\Entity
 */
class RevisionLista
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="revision_lista_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_revision", type="integer", nullable=false)
     */
    private $idRevision;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", nullable=false)
     */
    private $descripcion;



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
     * @return RevisionLista
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return RevisionLista
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
}
