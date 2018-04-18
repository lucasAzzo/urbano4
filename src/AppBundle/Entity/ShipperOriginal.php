<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of ShipperOriginal
 *
 * @author Lucas
 * @ORM\Table(name="shipper_original")
 * @ORM\Entity
 */
class ShipperOriginal {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
     /**
     * @var \AppBundle\Entity\Shipper
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Shipper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_shipper", referencedColumnName="id")
     * })
     */
    private $idShipper;
    
    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $idUsuario;
    
    /**
     * @var \AppBundle\Entity\OriginalFile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OriginalFile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_original_file", referencedColumnName="id")
     * })
     */
    private $idOriginalFile;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;
    
    
    public function getId() {
        return $this->id;
    }

    public function getIdShipper() {
        return $this->idShipper;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setIdShipper(\AppBundle\Entity\Shipper $idShipper) {
        $this->idShipper = $idShipper;
    }

    public function setIdUsuario(\AppBundle\Entity\User $idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setFecha(\DateTime $fecha) {
        $this->fecha = $fecha;
    }

    public function setDescripcion($desc) {
        $this->descripcion = $desc;
    }
    
    public function getIdOriginalFile(){
        return $this->idOriginalFile;
    }

    public function setIdOriginalFile(\AppBundle\Entity\OriginalFile $idOriginalFile) {
        $this->idOriginalFile = $idOriginalFile;
    }




    
}
