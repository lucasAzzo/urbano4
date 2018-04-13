<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Legajo
 *
 * @author Lucas
 * @ORM\Table(name="legajo")
 * @ORM\Entity
 */
class Legajo {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idPersona;
    
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
     * @var string
     *
     * @ORM\Column(name="legajo_numero", type="string", length=8, nullable=false)
     */
    private $legajoNumero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=50, nullable=true)
     */
    private $empresa;
    
    public function getIdLegajo() {
        return $this->id;
    }

    public function getIdPersona(){
        return $this->idPersona;
    }

    

    public function getLegajoNumero() {
        return $this->legajoNumero;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setIdLegajo($idLegajo) {
        $this->idLegajo = $idLegajo;
    }

    public function setIdPersona(\AppBundle\Entity\Persona $idPersona) {
        $this->idPersona = $idPersona;
    }

    

    public function setLegajoNumero($legajoNumero) {
        $this->legajoNumero = $legajoNumero;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }
    
    public function getIdEstado(){
        return $this->idEstado;
    }

    public function setIdEstado(\AppBundle\Entity\Estado $idEstado) {
        $this->idEstado = $idEstado;
    }


    
    


    
}
