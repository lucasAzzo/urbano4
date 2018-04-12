<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of FileStructureStd
 *
 * @author Lucas
 * @ORM\Table(name="file_structure_std")
 * @ORM\Entity
 */
class FileStructureStd {
    
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
     * @ORM\Column(name="nombre_campo", type="string", length=255)
     */
    private $nombreCampo;
    
    /**
     * @var \AppBundle\Entity\Estado
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id_estado")
     * })
     */
    private $idEstado;
    
    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
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

    public function getNombreCampo() {
        return $this->nombreCampo;
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

    public function setNombreCampo($nombreCampo) {
        $this->nombreCampo = $nombreCampo;
    }

    public function setIdEstado(\AppBundle\Entity\Estado $idEstado) {
        $this->idEstado = $idEstado;
    }

    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setFecha(\DateTime $fecha) {
        $this->fecha = $fecha;
    }


    
}
