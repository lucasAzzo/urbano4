<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity
 */
class Estado {
    
    const ACTIVO = 1;
    const INACTIVO = 2;
    const ANULADO = 3;
    const PROCESADO = 4;

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
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="abreviado", type="string", length=255, nullable=true)
     */
    private $abreviado;
    
    
    public function __toString() {
        return $this->estado;
    }
    
    public function getIdEstado() {
        return $this->id;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getAbreviado() {
        return $this->abreviado;
    }

    public function setIdEstado($id) {
        $this->idEstado = $id;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setAbreviado($abreviado) {
        $this->abreviado = $abreviado;
    }


    
}
