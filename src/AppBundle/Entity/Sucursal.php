<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Sucursal
 *
 * @author Lucas
 * @ORM\Table(name="sucursal")
 * @ORM\Entity
 */
class Sucursal {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sucursal", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idSucursal;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sucursal", type="string", length=255, nullable=false)
     */
    private $sucursal;
    
    public function getIdSucursal() {
        return $this->idSucursal;
    }

    public function getSucursal() {
        return $this->sucursal;
    }

    public function setIdSucursal($idSucursal) {
        $this->idSucursal = $idSucursal;
    }

    public function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    public function __toString() {
        return $this->sucursal;
    }
    
}
