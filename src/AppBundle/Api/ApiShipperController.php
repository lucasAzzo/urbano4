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
        return new JsonResponse($shippers);
    }

    /**
     * @Route("/shippers/create", name="api_shipper_create")
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request) {
        $requestData = json_decode($request->getContent(),true);
        $requiredParams = [
            "idShipper" => $requestData["idShipper"],
            "idPais" => $requestData["idPais"],
            "idProvincia" => $requestData["idProvincia"],
            "idRegion" => $requestData["idRegion"],
            "idCiudad" => $requestData["idCiudad"],
            "idSucursalDefecto" => $requestData["idSucursalDefecto"],
            "shiRepresentante" => $requestData["shiRepresentante"],
            "shiRazonSocial" => $requestData["shiRazonSocial"],
            "shiDireccion" => $requestData["shiDireccion"],
            "shiTelefono" => $requestData["shiTelefono"],
            "shiCuit" => $requestData["shiCuit"],
            "idEstado" => $requestData["idEstado"],
            "idUsuario" => $requestData["idUsuario"]
        ];
        foreach ($requiredParams as $key => $value) {
            if(empty($value)){
                return new JsonResponse(["status" => "400", "message" => $key." is required"]);
            }
        }
        try{
            $em = $this->getDoctrine()->getManager();
            $shipper = new Shipper();
            //preparing the objects to be assigned to $shipper
            $date = new \DateTime();
            $countryId = $em->getRepository("AppBundle:Pais")->find($requestData["idPais"]);
            $provinceId = $em->getRepository("AppBundle:Provincia")->find($requestData["idProvincia"]);
            $regionId = $em->getRepository("AppBundle:Region")->find($requestData["idRegion"]);
            $stateId = $em->getRepository("AppBundle:Ciudad")->find($requestData["idCiudad"]);
            $defaultBranchOfficeId = $em->getRepository("AppBundle:Sucursal")->find($requestData["idSucursalDefecto"]);
            $statusId = $em->getRepository("AppBundle:Estado")->find($requestData["idEstado"]);
            //populating $server object
            $shipper->setIdShipper($requestData["idShipper"]);
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
//        $shipper->setIdUsuario($this->getUser());
//        $this->get('security.token_storage')->getToken()->getUser();
            $shipper->setAudFechaCreacion($date);
            $shipper->setAudFechaProc($date);
            $shipper->setAudHoraProc($date->format('H:i'));
            $em->persist($shipper);
            $em->flush();
        } catch(\Doctrine\DBAL\DBALException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        }


//        $request->getSession()->getFlashBag()->add('success','Se ha creado el shipper: "'. $shipper->getShiRazonSocial() . '" satisfactoriamente.');
        return new JsonResponse(["status" => "200", "message" => "OK"]);
    }

    /**
     * @Route("/shippers/edit/{_id_shipper}", name="shipper_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id_shipper) {
        $em = $this->getDoctrine()->getManager();

        $shipper = $em->getRepository(Shipper::class)->find($_id_shipper);

        $formulario = $this->createForm(
            ShipperType::class, $shipper, array('action' => $this->generateUrl('shipper_update', array('_id_shipper' => $_id_shipper)),
                'method' => 'PUT')
        );

        return $this->render('shipper/new_edit.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/shippers/update/{_id_shipper}", name="shipper_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id_shipper) {
        $em = $this->getDoctrine()->getManager();
        $shipper = $em->getRepository(Shipper::class)->find($_id_shipper);

        $formulario = $this->createForm(
            ShipperType::class, $shipper, array('action' => $this->generateUrl('shipper_update', array('_id_shipper' => $_id_shipper)),
            'method' => 'PUT'));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $date = new \DateTime();
            $shipper->setIdUsuario($this->getUser());
            $shipper->setAudFechaCreacion($date);
            $shipper->setAudFechaProc($date);
            $shipper->setAudHoraProc($date->format('H:i'));

            $em->persist($shipper);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado el shipper: "'. $shipper->getShiRazonSocial() . '" satisfactoriamente.');
            return $this->redirectToRoute('shipper_edit', array('_id_shipper' => $_id_shipper));
        }

        return $this->render('shipper/new_edit.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/shippers/delete/{_id_shipper}", name="shipper_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $_id_shipper) {
        $em = $this->getDoctrine()->getManager();
        $shipper = $em->getRepository(Shipper::class)->find($_id_shipper);
        $em->remove($shipper);
        $em->flush();
        return $this->redirectToRoute('shipper_index');
    }

}
