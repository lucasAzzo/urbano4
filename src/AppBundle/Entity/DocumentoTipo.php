<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoTipo
 *
 * @ORM\Table(name="documento_tipo")
 * @ORM\Entity
 */
class DocumentoTipo
{
    
    const DOCUMENTO_CUIT = 5;
    
    /**
     * @var string
     *
     * @ORM\Column(name="documento_tipo", type="string", length=255, nullable=false)
     */
    private $documentoTipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="documento_tipo_id_documento_tipo_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    
    public function __toString() {
        return $this->documentoTipo;
    }
    
    public function getDocumentoTipo() {
        return $this->documentoTipo;
    }

    public function getIdDocumentoTipo() {
        return $this->id;
    }

    public function setDocumentoTipo($documentoTipo) {
        $this->documentoTipo = $documentoTipo;
    }

    public function setIdDocumentoTipo($idDocumentoTipo) {
        $this->id= $idDocumentoTipo;
    }




}
