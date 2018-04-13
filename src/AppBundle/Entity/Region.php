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
 * Description of Region
 *
 * @author Lucas
 * @ORM\Table(name="region")
 * @ORM\Entity
 */
class Region {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_region", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=false)
     */
    private $region;
    
    public function getIdRegion() {
        return $this->id;
    }

    public function getRegion() {
        return $this->region;
    }

    public function setIdRegion($idRegion) {
        $this->id = $idRegion;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public function __toString() {
        return $this->region;
    }
    
}
