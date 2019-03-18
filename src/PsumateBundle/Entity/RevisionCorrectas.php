<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RevisionCorrectas
 *
 * @ORM\Table(name="revision_correctas")
 * @ORM\Entity
 */
class RevisionCorrectas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="revision_correctas_id_seq", allocationSize=1, initialValue=1)
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
     * @var string
     *
     * @ORM\Column(name="pregunta", type="string", nullable=false)
     */
    private $pregunta;

    /**
     * @var string
     *
     * @ORM\Column(name="respuesta_correcta", type="string", nullable=false)
     */
    private $respuestaCorrecta;



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
     * @return RevisionCorrectas
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
     * @return RevisionCorrectas
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
     * Set pregunta
     *
     * @param string $pregunta
     *
     * @return RevisionCorrectas
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return string
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set respuestaCorrecta
     *
     * @param string $respuestaCorrecta
     *
     * @return RevisionCorrectas
     */
    public function setRespuestaCorrecta($respuestaCorrecta)
    {
        $this->respuestaCorrecta = $respuestaCorrecta;

        return $this;
    }

    /**
     * Get respuestaCorrecta
     *
     * @return string
     */
    public function getRespuestaCorrecta()
    {
        return $this->respuestaCorrecta;
    }
}
