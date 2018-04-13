<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaDocumento
 *
 * @ORM\Table(name="persona_documento", indexes={@ORM\Index(name="IX_Relationship2", columns={"id_documento_tipo"}), @ORM\Index(name="IX_Relationship3", columns={"id_persona"})})
 * @ORM\Entity
 */
class PersonaDocumento
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona_documento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_documento_id_persona_documento_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona",inversedBy="documentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id_persona")
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\DocumentoTipo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DocumentoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_documento_tipo", referencedColumnName="id_documento_tipo")
     * })
     */
    private $idDocumentoTipo;
    
    public function getNumero() {
        return $this->numero;
    }

    public function getIdPersonaDocumento() {
        return $this->id;
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    public function getIdDocumentoTipo() {
        return $this->idDocumentoTipo;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setIdPersonaDocumento($idPersonaDocumento) {
        $this->id = $idPersonaDocumento;
    }

    public function setIdPersona(\AppBundle\Entity\Persona $idPersona=null) {
        $this->idPersona = $idPersona;
    }

    public function setIdDocumentoTipo(\AppBundle\Entity\DocumentoTipo $idDocumentoTipo) {
        $this->idDocumentoTipo = $idDocumentoTipo;
    }




}
