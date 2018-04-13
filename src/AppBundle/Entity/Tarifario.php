<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Tarifario
 *
 * @author Lucas
 * @ORM\Table(name="tarifario")
 * @ORM\Entity
 */
class Tarifario {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\Producto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_producto", referencedColumnName="id_producto")
     * })
     */
    protected $idProducto;
    
    /**
     * @var \AppBundle\Entity\Shipper
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Shipper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_shipper", referencedColumnName="id_shipper")
     * })
     */
    protected $idShipper;
    
    /**
     * @var \AppBundle\Entity\Sucursal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sucursal", referencedColumnName="id_sucursal")
     * })
     */
    protected $idSucursal;
    
    public function getIdTarifario() {
        return $this->id;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getIdShipper(){
        return $this->idShipper;
    }

    public function getIdSucursal(){
        return $this->idSucursal;
    }

    public function setIdTarifario($idTarifario) {
        $this->id = $idTarifario;
    }

    public function setIdProducto(\AppBundle\Entity\Producto $idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setIdShipper(\AppBundle\Entity\Shipper $idShipper) {
        $this->idShipper = $idShipper;
    }

    public function setIdSucursal(\AppBundle\Entity\Sucursal $idSucursal) {
        $this->idSucursal = $idSucursal;
    }


    
    
    
}
