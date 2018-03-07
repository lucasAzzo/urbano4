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
 * Description of Provincia
 *
 * @author Lucas
 * @ORM\Table(name="provincia")
 * @ORM\Entity
 */
class Provincia {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_provincia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idProvincia;
    
    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255, nullable=false)
     */
    private $provincia;
    
    public function getIdProvincia() {
        return $this->idProvincia;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function setIdProvincia($idProvincia) {
        $this->idProvincia = $idProvincia;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function __toString() {
        return $this->provincia;
    }
    
}
