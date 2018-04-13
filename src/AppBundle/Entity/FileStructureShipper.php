<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of FileStructureShipper
 *
 * @author Lucas
 * @ORM\Table(name="file_structure_shipper")
 * @ORM\Entity
 */
class FileStructureShipper {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\FileStructureStd
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FileStructureStd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idFileStructureStd;
    
    /**
     * @var \AppBundle\Entity\Shipper
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Shipper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idShipper;
    
    /**
     * @var \AppBundle\Entity\Producto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idProducto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_campo_shipper", type="string", length=255)
     */
    private $nombreCampoShipper;
    
    /**
     * 
     *
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;
    
    /**
     * @var \AppBundle\Entity\Estado
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idEstado;
    
    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idUsuario;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;
    
    public function getId() {
        return $this->id;
    }

    public function getIdFileStructureStd(){
        return $this->idFileStructureStd;
    }

    public function getIdShipper(){
        return $this->idShipper;
    }

    public function getIdProducto(){
        return $this->idProducto;
    }

    public function getNombreCampoShipper() {
        return $this->nombreCampoShipper;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function getIdEstado(){
        return $this->idEstado;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setIdFileStructureStd(\AppBundle\Entity\FileStructureStd $idFileStructureStd) {
        $this->idFileStructureStd = $idFileStructureStd;
    }

    public function setIdShipper(\AppBundle\Entity\Shipper $idShipper) {
        $this->idShipper = $idShipper;
    }

    public function setIdProducto(\AppBundle\Entity\Producto $idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setNombreCampoShipper($nombreCampoShipper) {
        $this->nombreCampoShipper = $nombreCampoShipper;
    }

    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function setIdEstado(\AppBundle\Entity\Estado $idEstado) {
        $this->idEstado = $idEstado;
    }

    public function setIdUsuario(\AppBundle\Entity\User $idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setFecha(\DateTime $fecha) {
        $this->fecha = $fecha;
    }


    
}
