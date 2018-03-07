<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Shipper;
use AppBundle\Form\ShipperType;

/**
 * Description of ShipperController
 *
 * @author Lucas
 */
class ShipperController extends Controller {
    
    /**
     * @Route("/shipper_index", name="shipper_index")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $shippers = $em->getRepository(Shipper::class)->findAll();
        
        return $this->render('shipper/index.html.twig', [
                    'shippers' => $shippers,
        ]);
    }
    
    /**
     * @Route("/shipper_new", name="shipper_new")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function newAction(Request $request) {
        $shipper = new Shipper();

        $formulario = $this->createForm(
                ShipperType::class, $shipper, array('action' => $this->generateUrl('shipper_create'), 'method' => 'POST')
        );

        return $this->render('shipper/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/shipper_create", name="shipper_create")
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $shipper = new Shipper();
        $formulario = $this->createForm(
                ShipperType::class, $shipper, array('action' => $this->generateUrl('shipper_create'),
            'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $date = new \DateTime();
            $shipper->setIdUsuario($this->getUser());
            $shipper->setAudFechaCreacion($date);
            $shipper->setAudFechaProc($date);
            $shipper->setAudHoraProc($date->format('H:i'));
            
            $em->persist($shipper);
            $em->flush();
            return $this->redirectToRoute('shipper_edit', array('id_shipper' => $shipper->getIdShipper()));
        }

        return $this->render('shipper/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/shipper_edit/{id_shipper}", name="shipper_edit")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction(Request $request, $id_shipper) {
        $em = $this->getDoctrine()->getManager();

        $shipper = $em->getRepository(Shipper::class)->find($id_shipper);

        $formulario = $this->createForm(
                ShipperType::class, $shipper, array('action' => $this->generateUrl('shipper_update', array('id_shipper' => $id_shipper)),
            'method' => 'PUT')
        );

        return $this->render('shipper/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/shipper_update/{id_shipper}", name="shipper_update")
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id_shipper) {
        $em = $this->getDoctrine()->getManager();
        $shipper = $em->getRepository(Shipper::class)->find($id_shipper);

        $formulario = $this->createForm(
                ShipperType::class, $shipper, array('action' => $this->generateUrl('shipper_update', array('id_shipper' => $id_shipper)),
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
            return $this->redirectToRoute('shipper_edit', array('id_shipper' => $id_shipper));
        }
        
        return $this->render('shipper/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/shipper_delete/{id_shipper}", name="shipper_delete")
     * @Security("is_authenticated()")
     */
    public function deleteAction(Request $request, $id_shipper) {
        $em = $this->getDoctrine()->getManager();
        $shipper = $em->getRepository(Shipper::class)->find($id_shipper);
        $em->remove($shipper);
        $em->flush();
        return $this->redirectToRoute('shipper_index');
    }
    
}
