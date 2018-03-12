<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Shipper
 *
 * @author Lucas
 * @ORM\Table(name="shipper")
 * @ORM\Entity
 */
class Shipper {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_shipper", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idShipper;
    
    /**
     * @var \AppBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id_pais")
     * })
     */
    private $idPais;
    
    /**
     * @var \AppBundle\Entity\Provincia
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_provincia", referencedColumnName="id_provincia")
     * })
     */
    private $idProvincia;
    
    /**
     * @var \AppBundle\Entity\Region
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_region", referencedColumnName="id_region")
     * })
     */
    private $idRegion;
    
    /**
     * @var \AppBundle\Entity\Ciudad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciudad", referencedColumnName="id_ciudad")
     * })
     */
    private $idCiudad;
    
    /**
     * @var \AppBundle\Entity\Sucursal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sucursal_defecto", referencedColumnName="id_sucursal")
     * })
     */
    private $idSucursalDefecto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shi_representante", type="string", length=50, nullable=false)
     */
    private $shiRepresentante;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shi_razon_social", type="string", length=50, nullable=false)
     */
    private $shiRazonSocial;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shi_direccion", type="string", length=100, nullable=false)
     */
    private $shiDireccion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shi_telefono", type="string", length=20, nullable=false)
     */
    private $shiTelefono;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shi_cuit", type="string", length=20, nullable=false)
     */
    private $shiCuit;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shi_observacion", type="string", length=100, nullable=true)
     */
    private $shiObservacion;
    
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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;
    
    /**
     * @var string
     *
     * @ORM\Column(name="aud_fecha_creacion", type="datetime", nullable=false)
     */
    private $audFechaCreacion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="aud_fecha_proc", type="date", nullable=false)
     */
    private $audFechaProc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="aud_hora_proc", type="string", length=5,nullable=false)
     */
    private $audHoraProc;
    
    public function getIdShipper() {
        return $this->idShipper;
    }

    public function getIdPais(){
        return $this->idPais;
    }

    public function getIdProvincia(){
        return $this->idProvincia;
    }

    public function getIdRegion(){
        return $this->idRegion;
    }

    public function getIdCiudad(){
        return $this->idCiudad;
    }

    public function getIdSucursalDefecto(){
        return $this->idSucursalDefecto;
    }

    public function getShiRepresentante() {
        return $this->shiRepresentante;
    }

    public function getShiRazonSocial() {
        return $this->shiRazonSocial;
    }

    public function getShiDireccion() {
        return $this->shiDireccion;
    }

    public function getShiTelefono() {
        return $this->shiTelefono;
    }

    public function getShiCuit() {
        return $this->shiCuit;
    }

    public function getShiObservacion() {
        return $this->shiObservacion;
    }


    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getAudFechaCreacion() {
        return $this->audFechaCreacion;
    }

    public function getAudFechaProc() {
        return $this->audFechaProc;
    }

    public function getAudHoraProc() {
        return $this->audHoraProc;
    }

    public function setIdShipper($idShipper) {
        $this->idShipper = $idShipper;
    }

    public function setIdPais(\AppBundle\Entity\Pais $idPais) {
        $this->idPais = $idPais;
    }

    public function setIdProvincia(\AppBundle\Entity\Provincia $idProvincia) {
        $this->idProvincia = $idProvincia;
    }

    public function setIdRegion(\AppBundle\Entity\Region $idRegion) {
        $this->idRegion = $idRegion;
    }

    public function setIdCiudad(\AppBundle\Entity\Ciudad $idCiudad) {
        $this->idCiudad = $idCiudad;
    }

    public function setIdSucursalDefecto(\AppBundle\Entity\Sucursal $idSucursalDefecto) {
        $this->idSucursalDefecto = $idSucursalDefecto;
    }

    public function setShiRepresentante($shiRepresentante) {
        $this->shiRepresentante = $shiRepresentante;
    }

    public function setShiRazonSocial($shiRazonSocial) {
        $this->shiRazonSocial = $shiRazonSocial;
    }

    public function setShiDireccion($shiDireccion) {
        $this->shiDireccion = $shiDireccion;
    }

    public function setShiTelefono($shiTelefono) {
        $this->shiTelefono = $shiTelefono;
    }

    public function setShiCuit($shiCuit) {
        $this->shiCuit = $shiCuit;
    }

    public function setShiObservacion($shiObservacion) {
        $this->shiObservacion = $shiObservacion;
    }

    
    public function setIdUsuario(\AppBundle\Entity\User $idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setAudFechaCreacion($audFechaCreacion) {
        $this->audFechaCreacion = $audFechaCreacion;
    }

    public function setAudFechaProc($audFechaProc) {
        $this->audFechaProc = $audFechaProc;
    }

    public function setAudHoraProc($audHoraProc) {
        $this->audHoraProc = $audHoraProc;
    }
    
    public function getIdEstado(){
        return $this->idEstado;
    }

    public function setIdEstado(\AppBundle\Entity\Estado $idEstado) {
        $this->idEstado = $idEstado;
    }




    
}
