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
 * Description of Pais
 *
 * @author Lucas
 * @ORM\Table(name="pais")
 * @ORM\Entity
 */
class Pais {
    
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
     * @ORM\Column(name="pais", type="string", length=255, nullable=false)
     */
    private $pais;
    
    public function getIdPais() {
        return $this->id;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setIdPais($idPais) {
        $this->idPais = $idPais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function __toString() {
        return $this->pais;
    }
    
}
