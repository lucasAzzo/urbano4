<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Transporte
 *
 * @author Lucas
 * @ORM\Table(name="transporte")
 * @ORM\Entity
 */
class Transporte {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_transporte", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idTransporte;
    
    /**
     * @var string
     *
     * @ORM\Column(name="transporte", type="string", length=255, nullable=false)
     */
    private $transporte;
    
    public function getIdTransporte() {
        return $this->idTransporte;
    }

    public function getTransporte() {
        return $this->transporte;
    }

    public function setIdTransporte($idTransporte) {
        $this->idTransporte = $idTransporte;
    }

    public function setTransporte($transporte) {
        $this->transporte = $transporte;
    }

    public function __toString() {
        return $this->transporte;
    }
    
}
