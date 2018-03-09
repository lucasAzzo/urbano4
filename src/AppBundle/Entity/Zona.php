<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Subzona;

/**
 * Description of Zona
 *
 * @author Lucas
 * @ORM\Table(name="zona")
 * @ORM\Entity
 */
class Zona {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_zona", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idZona;
    
    /**
     * @var string
     *
     * @ORM\Column(name="zona", type="string", length=255, nullable=false)
     */
    private $zona;
    
    /**
     * @ORM\OneToMany(targetEntity="Subzona",mappedBy="idZona",cascade={"persist","remove"},orphanRemoval=true)
     */
    private $subzonas;
    
    public function __construct() {
        $this->subzonas = new ArrayCollection();
    }

    
    public function getSubzonas() {
        return $this->subzonas;
    }

    public function addSubzona(Subzona $s) {
        $s->setIdZona($this);
        $this->subzonas[] = $s;
    }

    public function removeSubzona(Subzona $s) {
        $this->subzonas->removeElement($s);
    }
    
    
    public function getIdZona() {
        return $this->idZona;
    }

    public function getZona() {
        return $this->zona;
    }

    public function setIdZona($idZona) {
        $this->idZona = $idZona;
    }

    public function setZona($zona) {
        $this->zona = $zona;
    }

    public function __toString() {
        return $this->zona;
    }
    
}
