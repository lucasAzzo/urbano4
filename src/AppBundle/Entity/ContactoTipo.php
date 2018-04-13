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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="contacto_tipo_id_contacto_tipo_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    public function __toString() {
        return $this->contactoTipo;
    }
    
    public function getContactoTipo() {
        return $this->contactoTipo;
    }

    public function getIdContactoTipo() {
        return $this->id;
    }

    public function setContactoTipo($contactoTipo) {
        $this->contactoTipo = $contactoTipo;
    }

    public function setIdContactoTipo($id) {
        $this->idContactoTipo = $id;
    }




}
