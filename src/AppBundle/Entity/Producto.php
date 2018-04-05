<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Producto
 *
 * @author Lucas
 * @ORM\Table(name="producto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductoRepository")
 */
class Producto {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_producto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idProducto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="producto", type="string", length=255, nullable=false)
     */
    private $producto;
    
    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }
    
    public function __toString() {
        return $this->producto;
    }


    
}
