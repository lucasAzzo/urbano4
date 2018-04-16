<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of PedidoShipper
 *
 * @author Lucas
 * @ORM\Table(name="pedido_shipper")
 * @ORM\Entity
 */
class PedidoShipper {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPedidoShipper;
    
    /**
     * @var \AppBundle\Entity\PedidoShipper
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PedidoShipper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pedido_shipper_padre", referencedColumnName="id")
     * })
     */
    private $padre;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_bulto", type="integer")
     */
    private $totalBruto;
    
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
     * @var \AppBundle\Entity\Producto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_producto", referencedColumnName="id")
     * })
     */
    private $idProducto;
    
    /**
     * @var \AppBundle\Entity\Servicio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Servicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio", referencedColumnName="id")
     * })
     */
    private $idServicio;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ciclo", type="date", nullable=true)
     */
    private $ciclo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="codigo_seguimiento", type="string", length=50)
     */
    private $codigoSeguimiento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="codigo_alternativo", type="string", length=50, nullable=true)
     */
    private $codigoAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo_documento", type="string", length=50)
     */
    private $tipoDocumento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=50)
     */
    private $documento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=50)
     */
    private $telefono;
    
    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=50)
     */
    private $celular;
    
    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=50)
     */
    private $calle;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=50)
     */
    private $numero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=50)
     */
    private $deparamento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="piso", type="string", length=50)
     */
    private $piso;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_postal", type="integer")
     */
    private $codigoPostal;
    
    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=50)
     */
    private $provincia;
    
    /**
     * @var string
     *
     * @ORM\Column(name="localidad", type="string", length=50)
     */
    private $localidad;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=30)
     */
    private $longitud;
    
    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", length=30)
     */
    private $latitud;
    
    /**
     * @var string
     *
     * @ORM\Column(name="calle_alternativo", type="string", length=50,nullable=true)
     */
    private $calleAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numero_alternativo", type="string", length=50, nullable=true)
     */
    private $numeroAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="departamento_alternativo", type="string", length=50, nullable=true)
     */
    private $departamentoAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="piso_alternativo", type="string", length=50, nullable=true)
     */
    private $pisoAlternativo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_postal_alternativo", type="integer", nullable=true)
     */
    private $codigoPostalAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="provincia_alternativo", type="string", length=50, nullable=true)
     */
    private $provinciaAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="localidad_alternativo", type="string", length=50, nullable=true)
     */
    private $localidadAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longitud_alternativo", type="string", length=30, nullable=true)
     */
    private $longitudAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="latitud_alternativo", type="string", length=30, nullable=true)
     */
    private $latitudAlternativo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo_documento_autorizado_1", type="string", length=30, nullable=true)
     */
    private $tipoDocumentoAutorizado1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="documento_autorizado_1", type="string", length=30, nullable=true)
     */
    private $documentoAutorizado1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_autorizado_1", type="string", length=30, nullable=true)
     */
    private $nombreAutorizado1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telefono_autorizado_1", type="string", length=30, nullable=true)
     */
    private $telefonoAutorizado1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="celular_autorizado_1", type="string", length=30, nullable=true)
     */
    private $celularAutorizado1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo_documento_autorizado_2", type="string", length=30, nullable=true)
     */
    private $tipoDocumentoAutorizado2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="documento_autorizado_2", type="string", length=30, nullable=true)
     */
    private $documentoAutorizado2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_autorizado_2", type="string", length=30, nullable=true)
     */
    private $nombreAutorizado2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telefono_autorizado_2", type="string", length=30, nullable=true)
     */
    private $telefonoAutorizado2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="celular_autorizado_2", type="string", length=30, nullable=true)
     */
    private $celularAutorizado2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_producto", type="string", length=50)
     */
    private $descripcion_producto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=100)
     */
    private $sku;
    
    /**
    * @ORM\Column(name="alto",type="decimal", precision=12, scale=2)
    */
    private $alto;
    
    /**
    * @ORM\Column(name="largo",type="decimal", precision=12, scale=2)
    */
    private $largo;
    
    /**
    * @ORM\Column(name="ancho",type="decimal", precision=12, scale=2)
    */
    private $ancho;
    
    /**
    * @ORM\Column(name="peso_declarado",type="decimal", precision=12, scale=2)
    */
    private $peso_declarado;
    
    /**
    * @ORM\Column(name="peso_aforado",type="decimal", precision=12, scale=2)
    */
    private $peso_aforado;
    
    /**
    * @ORM\Column(name="valor_declarado",type="decimal", precision=14, scale=2)
    */
    private $valor_declarado;
    
    /**
    * @ORM\Column(name="valor_contrareembolso",type="decimal", precision=14, scale=2)
    */
    private $valorContrareembolso;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;
    
    /**
     * @var \AppBundle\Entity\ModeloSms
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ModeloSms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modelo_sms", referencedColumnName="id")
     * })
     */
    private $idModeloSms;
    
    /**
     * @var \AppBundle\Entity\ModeloMail
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ModeloMail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modelo_mail", referencedColumnName="id")
     * })
     */
    private $idModeloMail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="marca_agua", type="string", length=100)
     */
    private $marca_agua;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pactado_base", type="date")
     */
    private $fechaPactadoBase;
    
    /**
     *
     * @ORM\Column(name="hora_pactado_base", type="time")
     */
    private $horaPactadoBase;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_pactado", type="datetime")
     */
    private $fechaHoraPactado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion1", type="string", length=100,nullable=true)
     */
    private $observacion1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion2", type="string", length=100,nullable=true)
     */
    private $observacion2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion3", type="string", length=100,nullable=true)
     */
    private $observacion3;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion4", type="string", length=100,nullable=true)
     */
    private $observacion4;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion5", type="string", length=100,nullable=true)
     */
    private $observacion5;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion6", type="string", length=100,nullable=true)
     */
    private $observacion6;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion7", type="string", length=100,nullable=true)
     */
    private $observacion7;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion8", type="string", length=100,nullable=true)
     */
    private $observacion8;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion9", type="string", length=100,nullable=true)
     */
    private $observacion9;
    
    /**
     * @var \AppBundle\Entity\Sucursal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sucursal_base", referencedColumnName="id")
     * })
     */
    private $idSucursalBase;
    
    /**
     * @var \AppBundle\Entity\Sucursal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sucursal_canalizacion", referencedColumnName="id")
     * })
     */
    private $idSucursalCanalizacion;
    
    /**
     * @var \AppBundle\Entity\Sucursal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sucursal_actual", referencedColumnName="id")
     * })
     */
    private $idSucursalActual;
    
    /**
     * @var \AppBundle\Entity\CHK
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CHK")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chk", referencedColumnName="id")
     * })
     */
    private $idCHK;
    
    /**
     * @var \AppBundle\Entity\Motivo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Motivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo", referencedColumnName="id")
     * })
     */
    private $idMotivo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actual", type="date")
     */
    private $fechaActual;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date")
     */
    private $fechaCreacion;
    
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
    
    public function getIdPedidoShipper() {
        return $this->idPedidoShipper;
    }

    public function getPadre(){
        return $this->padre;
    }

    public function getTotalBruto() {
        return $this->totalBruto;
    }

    public function getIdShipper(){
        return $this->idShipper;
    }

    public function getIdProducto(){
        return $this->idProducto;
    }

    public function getIdServicio(){
        return $this->idServicio;
    }

    public function getCiclo(): \DateTime {
        return $this->ciclo;
    }

    public function getCodigoSeguimiento() {
        return $this->codigoSeguimiento;
    }

    public function getCodigoAlternativo() {
        return $this->codigoAlternativo;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getDocumento() {
        return $this->documento;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getCalle() {
        return $this->calle;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getDeparamento() {
        return $this->deparamento;
    }

    public function getPiso() {
        return $this->piso;
    }

    public function getCodigoPostal() {
        return $this->codigoPostal;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getLongitud() {
        return $this->longitud;
    }

    public function getLatitud() {
        return $this->latitud;
    }

    public function getCalleAlternativo() {
        return $this->calleAlternativo;
    }

    public function getNumeroAlternativo() {
        return $this->numeroAlternativo;
    }

    public function getDepartamentoAlternativo() {
        return $this->departamentoAlternativo;
    }

    public function getPisoAlternativo() {
        return $this->pisoAlternativo;
    }

    public function getCodigoPostalAlternativo() {
        return $this->codigoPostalAlternativo;
    }

    public function getProvinciaAlternativo() {
        return $this->provinciaAlternativo;
    }

    public function getLocalidadAlternativo() {
        return $this->localidadAlternativo;
    }

    public function getLongitudAlternativo() {
        return $this->longitudAlternativo;
    }

    public function getLatitudAlternativo() {
        return $this->latitudAlternativo;
    }

    public function getTipoDocumentoAutorizado1() {
        return $this->tipoDocumentoAutorizado1;
    }

    public function getDocumentoAutorizado1() {
        return $this->documentoAutorizado1;
    }

    public function getNombreAutorizado1() {
        return $this->nombreAutorizado1;
    }

    public function getTelefonoAutorizado1() {
        return $this->telefonoAutorizado1;
    }

    public function getCelularAutorizado1() {
        return $this->celularAutorizado1;
    }

    public function getTipoDocumentoAutorizado2() {
        return $this->tipoDocumentoAutorizado2;
    }

    public function getDocumentoAutorizado2() {
        return $this->documentoAutorizado2;
    }

    public function getNombreAutorizado2() {
        return $this->nombreAutorizado2;
    }

    public function getTelefonoAutorizado2() {
        return $this->telefonoAutorizado2;
    }

    public function getCelularAutorizado2() {
        return $this->celularAutorizado2;
    }

    public function getDescripcion_producto() {
        return $this->descripcion_producto;
    }

    public function getSku() {
        return $this->sku;
    }

    public function getAlto() {
        return $this->alto;
    }

    public function getLargo() {
        return $this->largo;
    }

    public function getAncho() {
        return $this->ancho;
    }

    public function getPeso_declarado() {
        return $this->peso_declarado;
    }

    public function getPeso_aforado() {
        return $this->peso_aforado;
    }

    public function getValor_declarado() {
        return $this->valor_declarado;
    }

    public function getValorContrareembolso() {
        return $this->valorContrareembolso;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getIdModeloSms(){
        return $this->idModeloSms;
    }

    public function getIdModeloMail(){
        return $this->idModeloMail;
    }

    public function getMarca_agua() {
        return $this->marca_agua;
    }

    public function getFechaPactadoBase(){
        return $this->fechaPactadoBase;
    }

    public function getHoraPactadoBase() {
        return $this->horaPactadoBase;
    }

    public function getFechaHoraPactado(){
        return $this->fechaHoraPactado;
    }

    public function getObservacion1() {
        return $this->observacion1;
    }

    public function getObservacion2() {
        return $this->observacion2;
    }

    public function getObservacion3() {
        return $this->observacion3;
    }

    public function getObservacion4() {
        return $this->observacion4;
    }

    public function getObservacion5() {
        return $this->observacion5;
    }

    public function getObservacion6() {
        return $this->observacion6;
    }

    public function getObservacion7() {
        return $this->observacion7;
    }

    public function getObservacion8() {
        return $this->observacion8;
    }

    public function getObservacion9() {
        return $this->observacion9;
    }

    public function getIdSucursalBase(){
        return $this->idSucursalBase;
    }

    public function getIdSucursalCanalizacion(){
        return $this->idSucursalCanalizacion;
    }

    public function getIdSucursalActual(){
        return $this->idSucursalActual;
    }

    public function getIdCHK(){
        return $this->idCHK;
    }

    public function getIdMotivo(){
        return $this->idMotivo;
    }

    public function getFechaActual(){
        return $this->fechaActual;
    }

    public function getFechaCreacion(){
        return $this->fechaCreacion;
    }

    public function getIdEstado(){
        return $this->idEstado;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdPedidoShipper($idPedidoShipper) {
        $this->idPedidoShipper = $idPedidoShipper;
    }

    public function setPadre(\AppBundle\Entity\PedidoShipper $padre) {
        $this->padre = $padre;
    }

    public function setTotalBruto($totalBruto) {
        $this->totalBruto = $totalBruto;
    }

    public function setIdShipper(\AppBundle\Entity\Shipper $idShipper) {
        $this->idShipper = $idShipper;
    }

    public function setIdProducto(\AppBundle\Entity\Producto $idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setIdServicio(\AppBundle\Entity\Servicio $idServicio) {
        $this->idServicio = $idServicio;
    }

    public function setCiclo(\DateTime $ciclo) {
        $this->ciclo = $ciclo;
    }

    public function setCodigoSeguimiento($codigoSeguimiento) {
        $this->codigoSeguimiento = $codigoSeguimiento;
    }

    public function setCodigoAlternativo($codigoAlternativo) {
        $this->codigoAlternativo = $codigoAlternativo;
    }

    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setCalle($calle) {
        $this->calle = $calle;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setDeparamento($deparamento) {
        $this->deparamento = $deparamento;
    }

    public function setPiso($piso) {
        $this->piso = $piso;
    }

    public function setCodigoPostal($codigoPostal) {
        $this->codigoPostal = $codigoPostal;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

    public function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

    public function setCalleAlternativo($calleAlternativo) {
        $this->calleAlternativo = $calleAlternativo;
    }

    public function setNumeroAlternativo($numeroAlternativo) {
        $this->numeroAlternativo = $numeroAlternativo;
    }

    public function setDepartamentoAlternativo($departamentoAlternativo) {
        $this->departamentoAlternativo = $departamentoAlternativo;
    }

    public function setPisoAlternativo($pisoAlternativo) {
        $this->pisoAlternativo = $pisoAlternativo;
    }

    public function setCodigoPostalAlternativo($codigoPostalAlternativo) {
        $this->codigoPostalAlternativo = $codigoPostalAlternativo;
    }

    public function setProvinciaAlternativo($provinciaAlternativo) {
        $this->provinciaAlternativo = $provinciaAlternativo;
    }

    public function setLocalidadAlternativo($localidadAlternativo) {
        $this->localidadAlternativo = $localidadAlternativo;
    }

    public function setLongitudAlternativo($longitudAlternativo) {
        $this->longitudAlternativo = $longitudAlternativo;
    }

    public function setLatitudAlternativo($latitudAlternativo) {
        $this->latitudAlternativo = $latitudAlternativo;
    }

    public function setTipoDocumentoAutorizado1($tipoDocumentoAutorizado1) {
        $this->tipoDocumentoAutorizado1 = $tipoDocumentoAutorizado1;
    }

    public function setDocumentoAutorizado1($documentoAutorizado1) {
        $this->documentoAutorizado1 = $documentoAutorizado1;
    }

    public function setNombreAutorizado1($nombreAutorizado1) {
        $this->nombreAutorizado1 = $nombreAutorizado1;
    }

    public function setTelefonoAutorizado1($telefonoAutorizado1) {
        $this->telefonoAutorizado1 = $telefonoAutorizado1;
    }

    public function setCelularAutorizado1($celularAutorizado1) {
        $this->celularAutorizado1 = $celularAutorizado1;
    }

    public function setTipoDocumentoAutorizado2($tipoDocumentoAutorizado2) {
        $this->tipoDocumentoAutorizado2 = $tipoDocumentoAutorizado2;
    }

    public function setDocumentoAutorizado2($documentoAutorizado2) {
        $this->documentoAutorizado2 = $documentoAutorizado2;
    }

    public function setNombreAutorizado2($nombreAutorizado2) {
        $this->nombreAutorizado2 = $nombreAutorizado2;
    }

    public function setTelefonoAutorizado2($telefonoAutorizado2) {
        $this->telefonoAutorizado2 = $telefonoAutorizado2;
    }

    public function setCelularAutorizado2($celularAutorizado2) {
        $this->celularAutorizado2 = $celularAutorizado2;
    }

    public function setDescripcion_producto($descripcion_producto) {
        $this->descripcion_producto = $descripcion_producto;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function setAlto($alto) {
        $this->alto = $alto;
    }

    public function setLargo($largo) {
        $this->largo = $largo;
    }

    public function setAncho($ancho) {
        $this->ancho = $ancho;
    }

    public function setPeso_declarado($peso_declarado) {
        $this->peso_declarado = $peso_declarado;
    }

    public function setPeso_aforado($peso_aforado) {
        $this->peso_aforado = $peso_aforado;
    }

    public function setValor_declarado($valor_declarado) {
        $this->valor_declarado = $valor_declarado;
    }

    public function setValorContrareembolso($valorContrareembolso) {
        $this->valorContrareembolso = $valorContrareembolso;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setIdModeloSms(\AppBundle\Entity\ModeloSms $idModeloSms) {
        $this->idModeloSms = $idModeloSms;
    }

    public function setIdModeloMail(\AppBundle\Entity\ModeloMail $idModeloMail) {
        $this->idModeloMail = $idModeloMail;
    }

    public function setMarca_agua($marca_agua) {
        $this->marca_agua = $marca_agua;
    }

    public function setFechaPactadoBase(\DateTime $fechaPactadoBase) {
        $this->fechaPactadoBase = $fechaPactadoBase;
    }

    public function setHoraPactadoBase($horaPactadoBase) {
        $this->horaPactadoBase = $horaPactadoBase;
    }

    public function setFechaHoraPactado(\DateTime $fechaHoraPactado) {
        $this->fechaHoraPactado = $fechaHoraPactado;
    }

    public function setObservacion1($observacion1) {
        $this->observacion1 = $observacion1;
    }

    public function setObservacion2($observacion2) {
        $this->observacion2 = $observacion2;
    }

    public function setObservacion3($observacion3) {
        $this->observacion3 = $observacion3;
    }

    public function setObservacion4($observacion4) {
        $this->observacion4 = $observacion4;
    }

    public function setObservacion5($observacion5) {
        $this->observacion5 = $observacion5;
    }

    public function setObservacion6($observacion6) {
        $this->observacion6 = $observacion6;
    }

    public function setObservacion7($observacion7) {
        $this->observacion7 = $observacion7;
    }

    public function setObservacion8($observacion8) {
        $this->observacion8 = $observacion8;
    }

    public function setObservacion9($observacion9) {
        $this->observacion9 = $observacion9;
    }

    public function setIdSucursalBase(\AppBundle\Entity\Sucursal $idSucursalBase) {
        $this->idSucursalBase = $idSucursalBase;
    }

    public function setIdSucursalCanalizacion(\AppBundle\Entity\Sucursal $idSucursalCanalizacion) {
        $this->idSucursalCanalizacion = $idSucursalCanalizacion;
    }

    public function setIdSucursalActual(\AppBundle\Entity\Sucursal $idSucursalActual) {
        $this->idSucursalActual = $idSucursalActual;
    }

    public function setIdCHK(\AppBundle\Entity\CHK $idCHK) {
        $this->idCHK = $idCHK;
    }

    public function setIdMotivo(\AppBundle\Entity\Motivo $idMotivo) {
        $this->idMotivo = $idMotivo;
    }

    public function setFechaActual(\DateTime $fechaActual) {
        $this->fechaActual = $fechaActual;
    }

    public function setFechaCreacion(\DateTime $fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function setIdEstado(\AppBundle\Entity\Estado $idEstado) {
        $this->idEstado = $idEstado;
    }

    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario) {
        $this->idUsuario = $idUsuario;
    }


    
    
    
    
}
