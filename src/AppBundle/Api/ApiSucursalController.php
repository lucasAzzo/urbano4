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
use AppBundle\Entity\Zona;
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
 * Description of ApiSucursalController
 *
 * @author Lucas
 * @Route("/api")
 */
class ApiSucursalController extends Controller {

    /**
         * @Route("/sucursales", name="api_sucursal_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $shippers = $em->getRepository(Sucursal::class)->findByArrayResult();
        return new JsonResponse($shippers);
    }

    /**
     * @Route("/sucursal/create", name="api_sucursal_create")
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request) {
        $requestData = json_decode($request->getContent(),true);
        $requiredParams = [
            "idsucursal" => $requestData["idsucursal"],
            "sucursal" => $requestData["sucursal"],
            "id_zona" => $requestData["id_zona"]
        ];
        foreach ($requiredParams as $key => $value) {
            if(empty($value)){
                return new JsonResponse(["status" => "400", "message" => $key." is required"]);
            }
        }
        try{
            $em = $this->getDoctrine()->getManager();
            $sucursal = new Sucursal();

            $date = new \DateTime();
            $zonaId = $em->getRepository("AppBundle:Zona")->find($requestData["id_zona"]);

            //populating $server object
            $sucursal->setIdSucursal($requestData["idsucursal"]);
            $sucursal->setSucursal($sucursal);
            $sucursal->setIdZona($zonaId);

            $em->persist($sucursal);
            $em->flush();
        } catch(\Doctrine\DBAL\DBALException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(["status" => "400", "message" => $e->getMessage()]);
        }


//        $request->getSession()->getFlashBag()->add('success','Se ha creado la sucursal: "'. $sucursal->getsucursal() . '" satisfactoriamente.');
        return new JsonResponse(["status" => "200", "message" => "OK"]);
    }

    /**
     * @Route("/sucursal/edit/{_id_sucursal}", name="sucursal_edit")
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
     * @Route("/sucursal/update/{_id_sucursal}", name="sucursal_update")
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
     * @Route("/shippers/delete/{_id_shipper}", name="sucursal_delete")
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
