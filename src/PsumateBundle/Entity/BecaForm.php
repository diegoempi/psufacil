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
     * @ORM\Column(name="al_nombres", type="string", nullable=true)
     */
    private $alNombres;

    /**
     * @var string
     *
     * @ORM\Column(name="al_ape_mat", type="string", nullable=true)
     */
    private $alApeMat;

    /**
     * @var string
     *
     * @ORM\Column(name="al_ape_pat", type="string", nullable=true)
     */
    private $alApePat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="al_nacimiento", type="date", nullable=true)
     */
    private $alNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="al_email", type="string", nullable=true)
     */
    private $alEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="al_telefono", type="string", nullable=true)
     */
    private $alTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="al_rut", type="string", nullable=true)
     */
    private $alRut;

    /**
     * @var string
     *
     * @ORM\Column(name="ap_nombres", type="string", nullable=true)
     */
    private $apNombres;

    /**
     * @var string
     *
     * @ORM\Column(name="ap_ape_mat", type="string", nullable=true)
     */
    private $apApeMat;

    /**
     * @var string
     *
     * @ORM\Column(name="ap_ape_pat", type="string", nullable=true)
     */
    private $apApePat;

    /**
     * @var string
     *
     * @ORM\Column(name="ap_email", type="string", nullable=true)
     */
    private $apEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="ap_telefono", type="integer", nullable=true)
     */
    private $apTelefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="al_comuna", type="integer", nullable=true)
     */
    private $alComuna;

    /**
     * @var integer
     *
     * @ORM\Column(name="al_region", type="integer", nullable=true)
     */
    private $alRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="razones_beca", type="text", nullable=true)
     */
    private $razonesBeca;

    /**
     * @var integer
     *
     * @ORM\Column(name="al_colegio", type="integer", nullable=true)
     */
    private $alColegio;



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
     * Set alNombres
     *
     * @param string $alNombres
     *
     * @return BecaForm
     */
    public function setAlNombres($alNombres)
    {
        $this->alNombres = $alNombres;

        return $this;
    }

    /**
     * Get alNombres
     *
     * @return string
     */
    public function getAlNombres()
    {
        return $this->alNombres;
    }

    /**
     * Set alApeMat
     *
     * @param string $alApeMat
     *
     * @return BecaForm
     */
    public function setAlApeMat($alApeMat)
    {
        $this->alApeMat = $alApeMat;

        return $this;
    }

    /**
     * Get alApeMat
     *
     * @return string
     */
    public function getAlApeMat()
    {
        return $this->alApeMat;
    }

    /**
     * Set alApePat
     *
     * @param string $alApePat
     *
     * @return BecaForm
     */
    public function setAlApePat($alApePat)
    {
        $this->alApePat = $alApePat;

        return $this;
    }

    /**
     * Get alApePat
     *
     * @return string
     */
    public function getAlApePat()
    {
        return $this->alApePat;
    }

    /**
     * Set alNacimiento
     *
     * @param \DateTime $alNacimiento
     *
     * @return BecaForm
     */
    public function setAlNacimiento($alNacimiento)
    {
        $this->alNacimiento = $alNacimiento;

        return $this;
    }

    /**
     * Get alNacimiento
     *
     * @return \DateTime
     */
    public function getAlNacimiento()
    {
        return $this->alNacimiento;
    }

    /**
     * Set alEmail
     *
     * @param string $alEmail
     *
     * @return BecaForm
     */
    public function setAlEmail($alEmail)
    {
        $this->alEmail = $alEmail;

        return $this;
    }

    /**
     * Get alEmail
     *
     * @return string
     */
    public function getAlEmail()
    {
        return $this->alEmail;
    }

    /**
     * Set alTelefono
     *
     * @param string $alTelefono
     *
     * @return BecaForm
     */
    public function setAlTelefono($alTelefono)
    {
        $this->alTelefono = $alTelefono;

        return $this;
    }

    /**
     * Get alTelefono
     *
     * @return string
     */
    public function getAlTelefono()
    {
        return $this->alTelefono;
    }

    /**
     * Set alRut
     *
     * @param string $alRut
     *
     * @return BecaForm
     */
    public function setAlRut($alRut)
    {
        $this->alRut = $alRut;

        return $this;
    }

    /**
     * Get alRut
     *
     * @return string
     */
    public function getAlRut()
    {
        return $this->alRut;
    }

    /**
     * Set apNombres
     *
     * @param string $apNombres
     *
     * @return BecaForm
     */
    public function setApNombres($apNombres)
    {
        $this->apNombres = $apNombres;

        return $this;
    }

    /**
     * Get apNombres
     *
     * @return string
     */
    public function getApNombres()
    {
        return $this->apNombres;
    }

    /**
     * Set apApeMat
     *
     * @param string $apApeMat
     *
     * @return BecaForm
     */
    public function setApApeMat($apApeMat)
    {
        $this->apApeMat = $apApeMat;

        return $this;
    }

    /**
     * Get apApeMat
     *
     * @return string
     */
    public function getApApeMat()
    {
        return $this->apApeMat;
    }

    /**
     * Set apApePat
     *
     * @param string $apApePat
     *
     * @return BecaForm
     */
    public function setApApePat($apApePat)
    {
        $this->apApePat = $apApePat;

        return $this;
    }

    /**
     * Get apApePat
     *
     * @return string
     */
    public function getApApePat()
    {
        return $this->apApePat;
    }

    /**
     * Set apEmail
     *
     * @param string $apEmail
     *
     * @return BecaForm
     */
    public function setApEmail($apEmail)
    {
        $this->apEmail = $apEmail;

        return $this;
    }

    /**
     * Get apEmail
     *
     * @return string
     */
    public function getApEmail()
    {
        return $this->apEmail;
    }

    /**
     * Set apTelefono
     *
     * @param integer $apTelefono
     *
     * @return BecaForm
     */
    public function setApTelefono($apTelefono)
    {
        $this->apTelefono = $apTelefono;

        return $this;
    }

    /**
     * Get apTelefono
     *
     * @return integer
     */
    public function getApTelefono()
    {
        return $this->apTelefono;
    }

    /**
     * Set alComuna
     *
     * @param integer $alComuna
     *
     * @return BecaForm
     */
    public function setAlComuna($alComuna)
    {
        $this->alComuna = $alComuna;

        return $this;
    }

    /**
     * Get alComuna
     *
     * @return integer
     */
    public function getAlComuna()
    {
        return $this->alComuna;
    }

    /**
     * Set alRegion
     *
     * @param integer $alRegion
     *
     * @return BecaForm
     */
    public function setAlRegion($alRegion)
    {
        $this->alRegion = $alRegion;

        return $this;
    }

    /**
     * Get alRegion
     *
     * @return integer
     */
    public function getAlRegion()
    {
        return $this->alRegion;
    }

    /**
     * Set razonesBeca
     *
     * @param string $razonesBeca
     *
     * @return BecaForm
     */
    public function setRazonesBeca($razonesBeca)
    {
        $this->razonesBeca = $razonesBeca;

        return $this;
    }

    /**
     * Get razonesBeca
     *
     * @return string
     */
    public function getRazonesBeca()
    {
        return $this->razonesBeca;
    }

    /**
     * Set alColegio
     *
     * @param integer $alColegio
     *
     * @return BecaForm
     */
    public function setAlColegio($alColegio)
    {
        $this->alColegio = $alColegio;

        return $this;
    }

    /**
     * Get alColegio
     *
     * @return integer
     */
    public function getAlColegio()
    {
        return $this->alColegio;
    }
}
