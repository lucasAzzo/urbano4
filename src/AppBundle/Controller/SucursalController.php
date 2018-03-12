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

/**
 * Description of SucursalController
 *
 * @author Lucas
 */
class SucursalController extends Controller {
    
    /**
     * @Route("/sucursal_index", name="sucursal_index")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $sucursales = $em->getRepository(Sucursal::class)->findAll();
        
        return $this->render('sucursal/index.html.twig', [
                    'sucursales' => $sucursales,
        ]);
    }
    
    /**
     * @Route("/sucursal_new", name="sucursal_new")
     * @Method("GET")
     * @Security("is_authenticated()")
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
     * @Route("/sucursal_create", name="sucursal_create")
     * @Method("POST")
     * @Security("is_authenticated()")
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
            return $this->redirectToRoute('sucursal_edit', array('id_sucursal' => $sucursal->getIdSucursal()));
        }

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursal_edit/{id_sucursal}", name="sucursal_edit")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction(Request $request, $id_sucursal) {
        $em = $this->getDoctrine()->getManager();

        $sucursal = $em->getRepository(Sucursal::class)->find($id_sucursal);

        $formulario = $this->createForm(
                SucursalType::class, $sucursal, array('action' => $this->generateUrl('sucursal_update', array('id_sucursal' => $id_sucursal)),
            'method' => 'PUT')
        );

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursal_update/{id_sucursal}", name="sucursal_update")
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id_sucursal) {
        $em = $this->getDoctrine()->getManager();
        $sucursal = $em->getRepository(Sucursal::class)->find($id_sucursal);

        $formulario = $this->createForm(
                SucursalType::class, $sucursal, array('action' => $this->generateUrl('sucursal_update', array('id_sucursal' => $id_sucursal)),
            'method' => 'PUT'));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($sucursal);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado la sucursal : "'. $sucursal->getSucursal() . '" satisfactoriamente.');
            return $this->redirectToRoute('sucursal_edit', array('id_sucursal' => $id_sucursal));
        }

        return $this->render('sucursal/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/sucursal_delete/{id_sucursal}", name="sucursal_delete")
     * @Security("is_authenticated()")
     */
    public function deleteAction(Request $request, $id_sucursal) {
        $em = $this->getDoctrine()->getManager();
        $sucursal = $em->getRepository(Sucursal::class)->find($id_sucursal);
        $em->remove($sucursal);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success','Se ha eliminado la sucursal : "'. $sucursal->getSucursal() . '" satisfactoriamente.');
        return $this->redirectToRoute('sucursal_index');
    }
    
}
