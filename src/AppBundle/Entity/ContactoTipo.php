<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactoTipo
 *
 * @ORM\Table(name="contacto_tipo")
 * @ORM\Entity
 */
class ContactoTipo
{
    /**
     * @var string
     *
     * @ORM\Column(name="contacto_tipo", type="string", length=255, nullable=false)
     */
    private $contactoTipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_contacto_tipo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contacto_tipo_id_contacto_tipo_seq", allocationSize=1, initialValue=1)
     */
    private $idContactoTipo;
    
    public function __toString() {
        return $this->contactoTipo;
    }
    
    public function getContactoTipo() {
        return $this->contactoTipo;
    }

    public function getIdContactoTipo() {
        return $this->idContactoTipo;
    }

    public function setContactoTipo($contactoTipo) {
        $this->contactoTipo = $contactoTipo;
    }

    public function setIdContactoTipo($idContactoTipo) {
        $this->idContactoTipo = $idContactoTipo;
    }




}
