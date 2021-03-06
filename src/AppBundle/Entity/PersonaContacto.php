<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaContacto
 *
 * @ORM\Table(name="persona_contacto", indexes={@ORM\Index(name="IX_Relationship4", columns={"id_contacto_tipo"}), @ORM\Index(name="IX_Relationship5", columns={"id_persona"})})
 * @ORM\Entity
 */
class PersonaContacto
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero_contacto", type="string", length=255, nullable=false)
     */
    private $numeroContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_contacto_id_persona_contacto_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona",inversedBy="contactos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id")
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\ContactoTipo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ContactoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contacto_tipo", referencedColumnName="id")
     * })
     */
    private $idContactoTipo;
    
    public function getNumeroContacto() {
        return $this->numeroContacto;
    }

    public function getIdPersonaContacto() {
        return $this->id;
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    public function getIdContactoTipo() {
        return $this->idContactoTipo;
    }

    public function setNumeroContacto($numeroContacto) {
        $this->numeroContacto = $numeroContacto;
    }

    public function setIdPersonaContacto($idPersonaContacto) {
        $this->id = $idPersonaContacto;
    }

    public function setIdPersona(\AppBundle\Entity\Persona $idPersona=null) {
        $this->idPersona = $idPersona;
    }

    public function setIdContactoTipo(\AppBundle\Entity\ContactoTipo $idContactoTipo) {
        $this->idContactoTipo = $idContactoTipo;
    }




}
