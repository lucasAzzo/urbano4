<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Api;

use AppBundle\Entity\Ciudad;
use AppBundle\Entity\Pais;
use AppBundle\Entity\Provincia;
use AppBundle\Entity\Region;
use AppBundle\Entity\Sucursal;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Shipper;
use AppBundle\Form\ShipperType;
use AppBundle\Annotation\CheckPermission;

/**
 * Description of ApiShipperController
 *
 * @author Lucas
 *
 */
class ApiShipperController extends Controller {

    /**
     * @Route("/shippers", name="api_shipper_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $shippers = $em->getRepository(Shipper::class)->findByArrayResult();
        return new JsonResponse($shippers,200);
    }

    /**
     * @Route("/shippers/create", name="api_shipper_create")
     * @Method("POST")
     * Falta agregar la validacion del token
     * Example of use:
     * {"paisId":1,"provinciaId":1,"regionId":1,"ciudadId":2,"sucursalDefectoId":1,"shiRepresentante":"netshoes","shiRazonSocial":"meli","shiDireccion":"arias 2253","shiTelefono":11234567,"shiCuit":20201231230,"estadoId":1,"usuarioId":77}
     */
    public function createAction(Request $request) {
        try{
            if(empty($request->getContent()))
                return new JsonResponse(["status" => "400", "message" => "no data sent"],400);
            $requestData = json_decode($request->getContent(),true);
            $requiredParams = [
                "paisId" => $requestData["paisId"],
                "provinciaId" => $requestData["provinciaId"],
                "regionId" => $requestData["regionId"],
                "ciudadId" => $requestData["ciudadId"],
                "sucursalDefectoId" => $requestData["sucursalDefectoId"],
                "shiRepresentante" => $requestData["shiRepresentante"],
                "shiRazonSocial" => $requestData["shiRazonSocial"],
                "shiDireccion" => $requestData["shiDireccion"],
                "shiTelefono" => $requestData["shiTelefono"],
                "shiCuit" => $requestData["shiCuit"],
                "estadoId" => $requestData["estadoId"],
                "usuarioId" => $requestData["usuarioId"]
            ];
            foreach ($requiredParams as $key => $value) {
                if(empty($value)){
                    return new JsonResponse(["status" => "400", "message" => $key." is required"],400);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $shipper = new Shipper();
            //preparing the objects to be assigned to $shipper
            $date = new \DateTime();
            $countryId = $em->getRepository("AppBundle:Pais")->find($requestData["paisId"]);
            $provinceId = $em->getRepository("AppBundle:Provincia")->find($requestData["provinciaId"]);
            $regionId = $em->getRepository("AppBundle:Region")->find($requestData["regionId"]);
            $stateId = $em->getRepository("AppBundle:Ciudad")->find($requestData["ciudadId"]);
            $defaultBranchOfficeId = $em->getRepository("AppBundle:Sucursal")->find($requestData["sucursalDefectoId"]);
            $statusId = $em->getRepository("AppBundle:Estado")->find($requestData["estadoId"]);
            //populating $server object
            $shipper->setIdPais($countryId);
            $shipper->setIdProvincia($provinceId);
            $shipper->setIdRegion($regionId);
            $shipper->setIdCiudad($stateId);
            $shipper->setIdSucursalDefecto($defaultBranchOfficeId);
            $shipper->setShiRepresentante($requestData["shiRepresentante"]);
            $shipper->setShiRazonSocial($requestData["shiRazonSocial"]);
            $shipper->setShiDireccion($requestData["shiDireccion"]);
            $shipper->setShiTelefono($requestData["shiTelefono"]);
            $shipper->setShiCuit($requestData["shiCuit"]);
            $shipper->setIdEstado($statusId);
            $shipper->setAudFechaCreacion($date);
            $shipper->setAudFechaProc($date);
            $shipper->setAudHoraProc($date->format('H:i'));
            $em->persist($shipper);
            $em->flush();
            return new JsonResponse(["status" => "200", "message" => "OK"],200);
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
            if(empty($request->getContent()))
                return new JsonResponse(["status" => "400", "message" => "no data sent"],400);
            $requestData = json_decode($request->getContent(),true);
            $em = $this->getDoctrine()->getManager();
            $shipper = $em->getRepository("AppBundle:Shipper")->find($requestData["shipperId"]);
            if(empty($shipper)){
                return new JsonResponse(["status" => "400", "message" => "unknown shipper"],400);
            }
            $requiredParams = [
                "paisId" => $requestData["paisId"],
                "provinciaId" => $requestData["provinciaId"],
                "regionId" => $requestData["regionId"],
                "ciudadId" => $requestData["ciudadId"],
                "sucursalDefectoId" => $requestData["sucursalDefectoId"],
                "shiRepresentante" => $requestData["shiRepresentante"],
                "shiRazonSocial" => $requestData["shiRazonSocial"],
                "shiDireccion" => $requestData["shiDireccion"],
                "shiTelefono" => $requestData["shiTelefono"],
                "shiCuit" => $requestData["shiCuit"],
                "estadoId" => $requestData["estadoId"],
                "usuarioId" => $requestData["usuarioId"]
            ];
            foreach ($requiredParams as $key => $value) {
                if(empty($value)){
                    return new JsonResponse(["status" => "400", "message" => $key." is required"],400);
                }
            }
            $em = $this->getDoctrine()->getManager();
            //preparing the objects to be assigned to $shipper
            $date = new \DateTime();
            $countryId = $em->getRepository("AppBundle:Pais")->find($requestData["paisId"]);
            $provinceId = $em->getRepository("AppBundle:Provincia")->find($requestData["provinciaId"]);
            $regionId = $em->getRepository("AppBundle:Region")->find($requestData["regionId"]);
            $stateId = $em->getRepository("AppBundle:Ciudad")->find($requestData["ciudadId"]);
            $defaultBranchOfficeId = $em->getRepository("AppBundle:Sucursal")->find($requestData["sucursalDefectoId"]);
            $statusId = $em->getRepository("AppBundle:Estado")->find($requestData["estadoId"]);
            //populating $server object
            $shipper->setIdPais($countryId);
            $shipper->setIdProvincia($provinceId);
            $shipper->setIdRegion($regionId);
            $shipper->setIdCiudad($stateId);
            $shipper->setIdSucursalDefecto($defaultBranchOfficeId);
            $shipper->setShiRepresentante($requestData["shiRepresentante"]);
            $shipper->setShiRazonSocial($requestData["shiRazonSocial"]);
            $shipper->setShiDireccion($requestData["shiDireccion"]);
            $shipper->setShiTelefono($requestData["shiTelefono"]);
            $shipper->setShiCuit($requestData["shiCuit"]);
            $shipper->setIdEstado($statusId);
            $shipper->setAudFechaCreacion($date);
            $shipper->setAudFechaProc($date);
            $shipper->setAudHoraProc($date->format('H:i'));
            $em->persist($shipper);
            $em->flush();
            return new JsonResponse(["status" => "200", "message" => "OK"],200);
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
            if(empty($request->getContent()))
                return new JsonResponse(["status" => "400", "message" => "no data sent"],400);
            $requestData = json_decode($request->getContent(),true);
            if(empty($requestData["shipperId"]))
                return new JsonResponse(["status" => "400", "message" => "shipperId is required to perform this action"]);
            $em = $this->getDoctrine()->getManager();
            $shipper = $em->getRepository(Shipper::class)->find($requestData["shipperId"]);
            $em->remove($shipper);
            $em->flush();
            return new JsonResponse(["status" => "200", "message" => "OK"],200);
        } catch(\Doctrine\DBAL\DBALException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        }
    }
}
