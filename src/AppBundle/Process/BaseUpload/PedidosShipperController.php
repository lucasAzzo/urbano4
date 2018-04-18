<?php

namespace AppBundle\Process\BaseUpload;

//use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\PedidoShipper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PedidosShipperController extends Controller
{
//    private $container;
//
//    public function __construct(ContainerInterface $container)
//    {
//        $this->container = $container;
//    }
    /*
     * @var  array
     */
    public $requiredParamsErrors = [];

    public function requestParamChecker($shipmentParams)
    {
        $requiredParams = ["total_bulto", "codigo_seguimiento", "tipo_documento", "documento", "nombre", "telefono", "celular", "calle", "numero", "departamento", "piso", "codigo_postal", "provincia", "localidad", "longitud", "latitud", "descripcion_producto", "sku", "alto", "largo", "ancho", "peso_declarado", "peso_aforado", "valor_declarado", "valor_contrareembolso", "cantidad", "marca_agua", "fecha_pactado_base", "hora_pactado_base", "fecha_hora_pactado", "fecha_actual", "fecha_creacion"];
        $requestKeys = array_keys($shipmentParams);
        foreach ($requiredParams as $item) {
            if (!in_array($item, $requestKeys))
                return false;
        }
        return true;
    }

    public function validateShipmentRequiredParams($requestData)
    {
        $requiredParams = [
            "total_bulto" => $requestData["total_bulto"],
            "codigo_seguimiento" => $requestData["codigo_seguimiento"],
            "tipo_documento" => $requestData["tipo_documento"],
            "documento" => $requestData["documento"],
            "nombre" => $requestData["nombre"],
            "telefono" => $requestData["telefono"],
            "celular" => $requestData["celular"],
            "calle" => $requestData["calle"],
            "numero" => $requestData["numero"],
            "departamento" => $requestData["departamento"],
            "piso" => $requestData["piso"],
            "codigo_postal" => $requestData["codigo_postal"],
            "provincia" => $requestData["provincia"],
            "localidad" => $requestData["localidad"],
            "longitud" => $requestData["longitud"],
            "latitud" => $requestData["latitud"],
            "descripcion_producto" => $requestData["descripcion_producto"],
            "sku" => $requestData["sku"],
            "alto" => $requestData["alto"],
            "largo" => $requestData["largo"],
            "ancho" => $requestData["ancho"],
            "peso_declarado" => $requestData["peso_declarado"],
            "peso_aforado" => $requestData["peso_aforado"],
            "valor_declarado" => $requestData["valor_declarado"],
            "valor_contrareembolso" => $requestData["valor_contrareembolso"],
            "cantidad" => $requestData["cantidad"],
            "marca_agua" => $requestData["marca_agua"],
//            "fecha_pactado_base" => $requestData["fecha_pactado_base"],
//            "hora_pactado_base" => $requestData["hora_pactado_base"],
//            "fecha_hora_pactado" => $requestData["fecha_hora_pactado"],
//            "fecha_actual" => $requestData["fecha_actual"],
//            "fecha_creacion" => $requestData["fecha_creacion"]
        ];
        foreach ($requiredParams as $key => $value) {
            if (empty($value)) {
                //logger
                $this->requiredParamsErrors[] = $key;
            }
        }
        if(!empty($this->requiredParamsErrors))
            return false;
        return true;
    }
    public function populateShipment(PedidoShipper $shipment, $data){
        try{
            $em = $this->getDoctrine()->getManager();
            $date = new \DateTime();
//            $countryId = $em->getRepository("AppBundle:Pais")->find($data["paisId"]);
//            $provinceId = $em->getRepository("AppBundle:Provincia")->find($data["provinciaId"]);
//            $regionId = $em->getRepository("AppBundle:Region")->find($data["regionId"]);
//            $stateId = $em->getRepository("AppBundle:Ciudad")->find($data["ciudadId"]);
//            $defaultBranchOfficeId = $em->getRepository("AppBundle:Sucursal")->find($data["sucursalDefectoId"]);
//            $statusId = $em->getRepository("AppBundle:Estado")->find($data["estadoId"]);
// "total_bulto"
//"codigo_seguimiento"
//"tipo_documento"
//"documento"
//"nombre"
//"telefono"
//"celular"
//"calle"
//"numero"
//"departamento"
//"piso"
//"codigo_postal"
//"provincia"
//"localidad"
//"longitud"
//"latitud"
//"descripcion_producto"
//"sku"
//"alto"
//"largo"
//"ancho"
//"peso_declarado"
//"peso_aforado"
//"valor_declarado"
//"valor_contrareembolso"
//"cantidad"
//"marca_agua"
//"fecha_pactado_base"
//"hora_pactado_base"
//"fecha_hora_pactado"
//"fecha_actual"
//"fecha_creacio"
//            $shipment->($data[""]);
//            $shipment->setIdProvincia($provinceId);
//            $shipment->setIdRegion($regionId);
//            $shipment->setIdCiudad($stateId);
//            $shipment->setIdSucursalDefecto($defaultBranchOfficeId);
//            $shipment->setShiRepresentante($data["shiRepresentante"]);
//            $shipment->setShiRazonSocial($data["shiRazonSocial"]);
//            $shipment->setShiDireccion($data["shiDireccion"]);
//            $shipment->setShiTelefono($data["shiTelefono"]);
//            $shipment->setShiCuit($data["shiCuit"]);
//            $shipment->setIdEstado($statusId);
//            $shipment->setAudFechaCreacion($date);
//            $shipment->setAudFechaProc($date);
//            $shipment->setAudHoraProc($date->format('H:i'));
//            $em->persist($shipment);
//            $em->flush();
        } catch(\Doctrine\DBAL\DBALException $e){
            throw new Exception($e->getMessage(),$e->getCode());
        } catch(\Doctrine\ORM\ORMException $e){
            throw new Exception($e->getMessage(),$e->getCode());
        }
    }
}