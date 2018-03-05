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
 * Description of Modulo
 *
 * @author Lucas
 * @ORM\Table(name="modulo")
 * @ORM\Entity
 */
class Modulo {
    
     /**
     * @var integer
     *
     * @ORM\Column(name="id_modulo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idModulo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;
    
    /**
     * @ORM\OneToMany(targetEntity="Submodulo",mappedBy="idModulo")
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $submodulos;
    
    public function __construct() {
        $this->submodulos = new ArrayCollection();
    }

    
    public function getSubmodulos() {
        return $this->submodulos;
    }
    
    
    public function getIdModulo() {
        return $this->idModulo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function setIdModulo($idModulo) {
        $this->idModulo = $idModulo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setOrden($orden) {
        $this->orden = $orden;
    }


    
}
