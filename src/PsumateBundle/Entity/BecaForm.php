<?php

namespace PsumateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BecaForm
 *
 * @ORM\Table(name="beca_form")
 * @ORM\Entity
 */
class BecaForm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="beca_form_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres-al", type="string", nullable=true)
     */
    private $nombresAl;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido1-al", type="string", nullable=true)
     */
    private $apellido1Al;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido2-al", type="string", nullable=true)
     */
    private $apellido2Al;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechanac-al", type="date", nullable=true)
     */
    private $fechanacAl;

    /**
     * @var string
     *
     * @ORM\Column(name="correo-al", type="string", nullable=true)
     */
    private $correoAl;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono-al", type="string", nullable=true)
     */
    private $telefonoAl;

    /**
     * @var string
     *
     * @ORM\Column(name="rut-al", type="string", nullable=true)
     */
    private $rutAl;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres-ap", type="string", nullable=true)
     */
    private $nombresAp;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido1-ap", type="string", nullable=true)
     */
    private $apellido1Ap;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido2-ap", type="string", nullable=true)
     */
    private $apellido2Ap;

    /**
     * @var string
     *
     * @ORM\Column(name="correo-ap", type="string", nullable=true)
     */
    private $correoAp;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono-ap", type="integer", nullable=true)
     */
    private $telefonoAp;



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
     * Set nombresAl
     *
     * @param string $nombresAl
     *
     * @return BecaForm
     */
    public function setNombresAl($nombresAl)
    {
        $this->nombresAl = $nombresAl;

        return $this;
    }

    /**
     * Get nombresAl
     *
     * @return string
     */
    public function getNombresAl()
    {
        return $this->nombresAl;
    }

    /**
     * Set apellido1Al
     *
     * @param string $apellido1Al
     *
     * @return BecaForm
     */
    public function setApellido1Al($apellido1Al)
    {
        $this->apellido1Al = $apellido1Al;

        return $this;
    }

    /**
     * Get apellido1Al
     *
     * @return string
     */
    public function getApellido1Al()
    {
        return $this->apellido1Al;
    }

    /**
     * Set apellido2Al
     *
     * @param string $apellido2Al
     *
     * @return BecaForm
     */
    public function setApellido2Al($apellido2Al)
    {
        $this->apellido2Al = $apellido2Al;

        return $this;
    }

    /**
     * Get apellido2Al
     *
     * @return string
     */
    public function getApellido2Al()
    {
        return $this->apellido2Al;
    }

    /**
     * Set fechanacAl
     *
     * @param \DateTime $fechanacAl
     *
     * @return BecaForm
     */
    public function setFechanacAl($fechanacAl)
    {
        $this->fechanacAl = $fechanacAl;

        return $this;
    }

    /**
     * Get fechanacAl
     *
     * @return \DateTime
     */
    public function getFechanacAl()
    {
        return $this->fechanacAl;
    }

    /**
     * Set correoAl
     *
     * @param string $correoAl
     *
     * @return BecaForm
     */
    public function setCorreoAl($correoAl)
    {
        $this->correoAl = $correoAl;

        return $this;
    }

    /**
     * Get correoAl
     *
     * @return string
     */
    public function getCorreoAl()
    {
        return $this->correoAl;
    }

    /**
     * Set telefonoAl
     *
     * @param string $telefonoAl
     *
     * @return BecaForm
     */
    public function setTelefonoAl($telefonoAl)
    {
        $this->telefonoAl = $telefonoAl;

        return $this;
    }

    /**
     * Get telefonoAl
     *
     * @return string
     */
    public function getTelefonoAl()
    {
        return $this->telefonoAl;
    }

    /**
     * Set rutAl
     *
     * @param string $rutAl
     *
     * @return BecaForm
     */
    public function setRutAl($rutAl)
    {
        $this->rutAl = $rutAl;

        return $this;
    }

    /**
     * Get rutAl
     *
     * @return string
     */
    public function getRutAl()
    {
        return $this->rutAl;
    }

    /**
     * Set nombresAp
     *
     * @param string $nombresAp
     *
     * @return BecaForm
     */
    public function setNombresAp($nombresAp)
    {
        $this->nombresAp = $nombresAp;

        return $this;
    }

    /**
     * Get nombresAp
     *
     * @return string
     */
    public function getNombresAp()
    {
        return $this->nombresAp;
    }

    /**
     * Set apellido1Ap
     *
     * @param string $apellido1Ap
     *
     * @return BecaForm
     */
    public function setApellido1Ap($apellido1Ap)
    {
        $this->apellido1Ap = $apellido1Ap;

        return $this;
    }

    /**
     * Get apellido1Ap
     *
     * @return string
     */
    public function getApellido1Ap()
    {
        return $this->apellido1Ap;
    }

    /**
     * Set apellido2Ap
     *
     * @param string $apellido2Ap
     *
     * @return BecaForm
     */
    public function setApellido2Ap($apellido2Ap)
    {
        $this->apellido2Ap = $apellido2Ap;

        return $this;
    }

    /**
     * Get apellido2Ap
     *
     * @return string
     */
    public function getApellido2Ap()
    {
        return $this->apellido2Ap;
    }

    /**
     * Set correoAp
     *
     * @param string $correoAp
     *
     * @return BecaForm
     */
    public function setCorreoAp($correoAp)
    {
        $this->correoAp = $correoAp;

        return $this;
    }

    /**
     * Get correoAp
     *
     * @return string
     */
    public function getCorreoAp()
    {
        return $this->correoAp;
    }

    /**
     * Set telefonoAp
     *
     * @param integer $telefonoAp
     *
     * @return BecaForm
     */
    public function setTelefonoAp($telefonoAp)
    {
        $this->telefonoAp = $telefonoAp;

        return $this;
    }

    /**
     * Get telefonoAp
     *
     * @return integer
     */
    public function getTelefonoAp()
    {
        return $this->telefonoAp;
    }
}
