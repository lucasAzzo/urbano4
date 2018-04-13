<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Subzona
 *
 * @author Lucas
 * @ORM\Table(name="subzona")
 * @ORM\Entity
 */
class Subzona {
    
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
     * @ORM\Column(name="subzona", type="string", length=255, nullable=false)
     */
    private $subzona;
    
    /**
     * @var \AppBundle\Entity\Zona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Zona",inversedBy="subzonas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_zona", referencedColumnName="id_zona")
     * })
     */
    private $idZona;
    
    public function getIdSubzona() {
        return $this->id;
    }

    public function getSubzona() {
        return $this->subzona;
    }

    public function getIdZona(){
        return $this->idZona;
    }

    public function setIdSubzona($idSubzona) {
        $this->idSubzona = $idSubzona;
    }

    public function setSubzona($subzona) {
        $this->subzona = $subzona;
    }

    public function setIdZona(\AppBundle\Entity\Zona $idZona) {
        $this->idZona = $idZona;
    }
    
    public function __toString() {
        return $this->subzona;
    }


    
}
