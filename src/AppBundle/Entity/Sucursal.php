<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Sucursal
 *
 * @author Lucas
 * @ORM\Table(name="sucursal")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SucursalRepository")
 */
class Sucursal {
    
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
     * @ORM\Column(name="sucursal", type="string", length=255, nullable=false)
     */
    private $sucursal;
    
     /**
     * @var \AppBundle\Entity\Zona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Zona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_zona", referencedColumnName="id")
     * })
     */
    private $idZona;
    
    public function getIdSucursal() {
        return $this->id;
    }

    public function getSucursal() {
        return $this->sucursal;
    }

    public function setIdSucursal($idSucursal) {
        $this->id = $idSucursal;
    }

    public function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    public function __toString() {
        return $this->sucursal;
    }
    
    public function getIdZona(){
        return $this->idZona;
    }

    public function setIdZona(\AppBundle\Entity\Zona $idZona) {
        $this->idZona = $idZona;
    }


    
}
