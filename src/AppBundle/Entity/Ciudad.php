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
 * Description of Ciudad
 *
 * @author Lucas
 * @ORM\Table(name="ciudad")
 * @ORM\Entity
 */
class Ciudad {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255, nullable=false)
     */
    private $ciudad;
    
    public function getIdCiudad() {
        return $this->id;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function setIdCiudad($id) {
        $this->id = $id;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function __toString() {
        return $this->ciudad;
    }
    
}
