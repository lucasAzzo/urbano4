<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaDomicilio
 *
 * @ORM\Table(name="persona_domicilio", indexes={@ORM\Index(name="IX_Relationship9", columns={"id_persona"}), @ORM\Index(name="IX_Relationship10", columns={"id_domicilio_tipo"})})
 * @ORM\Entity
 */
class PersonaDomicilio {

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=82, nullable=false)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=20, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="piso", type="string", length=3, nullable=true)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="depto", type="string", length=3, nullable=true)
     */
    private $depto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona_domicilio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_domicilio_id_persona_domicilio_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\DomicilioTipo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DomicilioTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_domicilio_tipo", referencedColumnName="id_domicilio_tipo")
     * })
     */
    private $idDomicilioTipo;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona",inversedBy="domicilios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id_persona")
     * })
     */
    protected $idPersona;

    public function getCalle() {
        return $this->calle;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getPiso() {
        return $this->piso;
    }

    public function getDepto() {
        return $this->depto;
    }

    public function getIdPersonaDomicilio() {
        return $this->id;
    }

    public function getIdDomicilioTipo() {
        return $this->idDomicilioTipo;
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    public function setCalle($calle) {
        $this->calle = $calle;
        return $this;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    public function setPiso($piso) {
        $this->piso = $piso;
        return $this;
    }

    public function setDepto($depto) {
        $this->depto = $depto;
        return $this;
    }

    public function setIdPersonaDomicilio($idPersonaDomicilio) {
        $this->id = $idPersonaDomicilio;
        return $this;
    }

    public function setIdDomicilioTipo(\AppBundle\Entity\DomicilioTipo $idDomicilioTipo) {
        $this->idDomicilioTipo = $idDomicilioTipo;
        return $this;
    }

    public function setIdPersona(\AppBundle\Entity\Persona $idPersona=null) {
        $this->idPersona = $idPersona;
        return $this;
    }

}
