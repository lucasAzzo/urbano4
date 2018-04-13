<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DomicilioTipo
 *
 * @ORM\Table(name="domicilio_tipo")
 * @ORM\Entity
 */
class DomicilioTipo
{
    const DOMICILIO_FISCAL = 2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="domicilio_tipo", type="string", length=255, nullable=false)
     */
    private $domicilioTipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="domicilio_tipo_id_domicilio_tipo_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    public function __toString() {
        return $this->domicilioTipo;
    }
    
    public function getDomicilioTipo() {
        return $this->domicilioTipo;
    }

    public function getIdDomicilioTipo() {
        return $this->id;
    }

    public function setDomicilioTipo($domicilioTipo) {
        $this->domicilioTipo = $domicilioTipo;
    }

    public function setIdDomicilioTipo($idDomicilioTipo) {
        $this->id= $idDomicilioTipo;
    }




}
