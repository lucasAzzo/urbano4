<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Api;

use AppBundle\Process\BaseUpload\PedidosShipperController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Shipper;

/**
 * Description of ApiShipperPedidoController
 *
 * @author jbregant
 *
 */
class ApiShipperPedidoController extends Controller {

//    /**
//     * @Route("/shippers", name="api_shipper_index")
//     * @Method("GET")
//     * @CheckPermission()
//     */
//    public function indexAction(Request $request) {
//        $em = $this->getDoctrine()->getManager();
//        $shippers = $em->getRepository(Shipper::class)->findByArrayResult();
//        return new JsonResponse($shippers,201);
//    }

    /**
     * @Route("/shipment/add", name="api_shipper_shipment_add")
     * @Method("POST")
     * Falta agregar la validacion del token
     * Example of use:
     * {"paisId":1,"provinciaId":1,"regionId":1,"ciudadId":2,"sucursalDefectoId":1,"shiRepresentante":"netshoes","shiRazonSocial":"meli","shiDireccion":"arias 2253","shiTelefono":11234567,"shiCuit":20201231230,"estadoId":1,"usuarioId":77}
     */
    public function addShipmentAction(Request $request) {
        try{
            $shipment = new PedidosShipperController();
            $requestData = json_decode($request->getContent(),true);
            if(empty($requestData) || !$shipment->requestParamChecker($requestData)){
                //logger
                return new JsonResponse(["status" => "400", "message" => "bad request"],400);
            }
            if(!$shipment->validateShipmentRequiredParams($requestData)){
                //logger
                return new JsonResponse(["status" => "400", "message" => "required field(s): ".implode(", ", $shipment->requiredParamsErrors)],400);
            }

//            $shipper = new Shipper();
//            $this->populateUser($shipper,$requestData);
            //logger
            return new JsonResponse(["status" => "201", "message" => "OK"],201);
        } catch(\Doctrine\DBAL\DBALException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()],400);
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()],400);
        }
    }

    /**
     * @Route("/shippers/update", name="api_shipper_update")
     * @Method("PUT")
     * Example of use:
     * {"shipperId":1,"paisId":1,"provinciaId":1,"regionId":1,"ciudadId":2,"sucursalDefectoId":1,"shiRepresentante":"netshoes","shiRazonSocial":"meli","shiDireccion":"arias 2253","shiTelefono":11234567,"shiCuit":20201231230,"estadoId":1,"usuarioId":77}
     */
    public function updateAction(Request $request) {
        try{
            $requiredParams = ["shipperId", "paisId", "provinciaId", "regionId", "ciudadId", "sucursalDefectoId", "shiRepresentante", "shiRazonSocial", "shiDireccion", "shiTelefono", "shiCuit", "estadoId"];
            $requestData = json_decode($request->getContent(),true);
            if(empty($requestData) || !$this->requestParamChecker($requestData, $requiredParams)){
                //logger
                return new JsonResponse(["status" => "400", "message" => "bad request"],400);
            }
            $this->requiredParamChecker($requestData, true);
            if(!empty($this->requiredErrors))
                return new JsonResponse(["status" => "400", "message" => "required: ".implode(" ", $this->requiredErrors)]);
            $em = $this->getDoctrine()->getManager();
            $shipper = $em->getRepository("AppBundle:Shipper")->find($requestData["shipperId"]);
            if(empty($shipper)){
                return new JsonResponse(["status" => "400", "message" => "unknown shipper"],400);
            }
            $this->populateUser($shipper,$requestData,$em);
            //logger
            return new JsonResponse(["status" => "201", "message" => "OK"],201);
        } catch(\Doctrine\DBAL\DBALException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()],400);
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()],400);
        }
    }

    /**
     * @Route("/shippers/delete", name="api_shipper_delete")
     * @Method("DELETE")
     * Example of use:
     *{"shipperId":2}
     */
    public function deleteAction(Request $request) {
        try{
            $requiredParams = ["shipperId"];
            $requestData = json_decode($request->getContent(),true);
            if(empty($requestData) || !$this->requestParamChecker($requestData, $requiredParams)){
                //logger
                return new JsonResponse(["status" => "400", "message" => "bad request"],400);
            }
            $em = $this->getDoctrine()->getManager();
            $shipper = $em->getRepository(Shipper::class)->find($requestData["shipperId"]);
            if(empty($shipper))
                return new JsonResponse(["status" => "400", "message" => "bad request"],400);
            $em->remove($shipper);
            $em->flush();
            //logger
            return new JsonResponse(["status" => "201", "message" => "OK"],201);
        } catch(\Doctrine\DBAL\DBALException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        }
    }
    public function populateUser(Shipper $shipper, $data,$em = false){
        try{
            if(!$em)
                $em = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $countryId = $em->getRepository("AppBundle:Pais")->find($data["paisId"]);
            $provinceId = $em->getRepository("AppBundle:Provincia")->find($data["provinciaId"]);
            $regionId = $em->getRepository("AppBundle:Region")->find($data["regionId"]);
            $stateId = $em->getRepository("AppBundle:Ciudad")->find($data["ciudadId"]);
            $defaultBranchOfficeId = $em->getRepository("AppBundle:Sucursal")->find($data["sucursalDefectoId"]);
            $statusId = $em->getRepository("AppBundle:Estado")->find($data["estadoId"]);
            $shipper->setIdPais($countryId);
            $shipper->setIdProvincia($provinceId);
            $shipper->setIdRegion($regionId);
            $shipper->setIdCiudad($stateId);
            $shipper->setIdSucursalDefecto($defaultBranchOfficeId);
            $shipper->setShiRepresentante($data["shiRepresentante"]);
            $shipper->setShiRazonSocial($data["shiRazonSocial"]);
            $shipper->setShiDireccion($data["shiDireccion"]);
            $shipper->setShiTelefono($data["shiTelefono"]);
            $shipper->setShiCuit($data["shiCuit"]);
            $shipper->setIdEstado($statusId);
            $shipper->setAudFechaCreacion($date);
            $shipper->setAudFechaProc($date);
            $shipper->setAudHoraProc($date->format('H:i'));
            $em->persist($shipper);
            $em->flush();
        } catch(\Doctrine\DBAL\DBALException $e){
            throw new Exception($e->getMessage(),$e->getCode());
        } catch(\Doctrine\ORM\ORMException $e){
            throw new Exception($e->getMessage(),$e->getCode());
        }
    }
}
