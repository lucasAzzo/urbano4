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
use AppBundle\Entity\Sucursal;
use AppBundle\Form\SucursalType;
use AppBundle\Annotation\CheckPermission;

/**
 * Description of SucursalController
 *
 * @author Lucas
 */
class SucursalController extends Controller {
    
    /**
     * @Route("/sucursales", name="sucursal_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $sucursales = $em->getRepository(Sucursal::class)->findAll();
        
        return $this->render('sucursal/index.html.twig', [
                    'sucursales' => $sucursales,
        ]);
    }
    
    /**
     * @Route("/sucursales/new", name="sucursal_new")
     * @Method("GET")
     * @CheckPermission()
     */
    public function newAction(Request $request) {
        $sucursal = new Sucursal();

        $formulario = $this->createForm(
                SucursalType::class, $sucursal, array('action' => $this->generateUrl('sucursal_create'), 'method' => 'POST')
        );

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursales/create", name="sucursal_create")
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $sucursal = new Sucursal();
        $formulario = $this->createForm(
                SucursalType::class, $sucursal, array('action' => $this->generateUrl('sucursal_create'),
            'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($sucursal);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha creado la sucursal : "'. $sucursal->getSucursal() . '" satisfactoriamente.');
            return $this->redirectToRoute('sucursal_edit', array('_id_sucursal' => $sucursal->getIdSucursal()));
        }

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursales/edit/{_id_sucursal}", name="sucursal_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id_sucursal) {
        $em = $this->getDoctrine()->getManager();

        $sucursal = $em->getRepository(Sucursal::class)->find($_id_sucursal);

        $formulario = $this->createForm(
                SucursalType::class, $sucursal, array('action' => $this->generateUrl('sucursal_update', array('_id_sucursal' => $_id_sucursal)),
            'method' => 'PUT')
        );

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursales/update/{_id_sucursal}", name="sucursal_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id_sucursal) {
        $em = $this->getDoctrine()->getManager();
        $sucursal = $em->getRepository(Sucursal::class)->find($_id_sucursal);

        $formulario = $this->createForm(
                SucursalType::class, $sucursal, array('action' => $this->generateUrl('sucursal_update', array('_id_sucursal' => $_id_sucursal)),
            'method' => 'PUT'));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($sucursal);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado la sucursal : "'. $sucursal->getSucursal() . '" satisfactoriamente.');
            return $this->redirectToRoute('sucursal_edit', array('_id_sucursal' => $_id_sucursal));
        }

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursales/delete/{_id_sucursal}", name="sucursal_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $_id_sucursal) {
        $em = $this->getDoctrine()->getManager();
        $sucursal = $em->getRepository(Sucursal::class)->find($_id_sucursal);
        $em->remove($sucursal);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success','Se ha eliminado la sucursal : "'. $sucursal->getSucursal() . '" satisfactoriamente.');
        return $this->redirectToRoute('sucursal_index');
    }
    
}
