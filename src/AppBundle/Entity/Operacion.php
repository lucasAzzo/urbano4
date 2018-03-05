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
 * Description of Operacion
 *
 * @author Lucas
 * @ORM\Table(name="operacion")
 * @ORM\Entity
 */
class Operacion {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idOperacion;
    
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
     * @var \AppBundle\Entity\Submodulo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Submodulo",inversedBy="operaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_submodulo", referencedColumnName="id_submodulo")
     * })
     */
    private $idSubmodulo;
    
    
    public function getIdOperacion() {
        return $this->idOperacion;
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

    public function setIdOperacion($idOperacion) {
        $this->idOperacion = $idOperacion;
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
    
    public function getIdSubmodulo() {
        return $this->idSubmodulo;
    }

    public function setIdSubmodulo(\AppBundle\Entity\Submodulo $idSubmodulo) {
        $this->idSubmodulo = $idSubmodulo;
    }




    
}
