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
 * Description of Submodulo
 *
 * @author Lucas
 * @ORM\Table(name="submodulo")
 * @ORM\Entity
 */
class Submodulo {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_submodulo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idSubmodulo;
    
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
     * @var string
     *
     * @ORM\Column(name="path", type="string")
     */
    private $path;
    
    /**
     * @var string
     *
     * @ORM\Column(name="parametro", type="string")
     */
    private $parametro;
    
    /**
     * @var \AppBundle\Entity\Modulo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Modulo",inversedBy="submodulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id_modulo")
     * })
     */
    private $idModulo;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Operacion",mappedBy="idSubmodulo")
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $operaciones;
    
    public function __construct() {
        $this->operaciones = new ArrayCollection();
    }

    
    public function getOperaciones() {
        return $this->operaciones;
    }
    
    public function getIdSubmodulo() {
        return $this->idSubmodulo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function getPath() {
        return $this->path;
    }

    public function getParametro() {
        return $this->parametro;
    }

    public function setIdSubmodulo($idSubmodulo) {
        $this->idSubmodulo = $idSubmodulo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setParametro($parametro) {
        $this->parametro = $parametro;
    }
    
    public function getIdModulo(){
        return $this->idModulo;
    }

    public function setIdModulo(\AppBundle\Entity\Modulo $idModulo) {
        $this->idModulo = $idModulo;
    }




    
}
