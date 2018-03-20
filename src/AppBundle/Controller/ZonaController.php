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
use AppBundle\Entity\Zona;
use AppBundle\Form\ZonaType;
use AppBundle\Annotation\CheckPermission;

/**
 * Description of ZonaController
 *
 * @author Lucas
 */
class ZonaController extends Controller {
    
    /**
     * @Route("/zonas", name="zona_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $zonas = $em->getRepository(Zona::class)->findAll();
        
        return $this->render('zona/index.html.twig', [
                    'zonas' => $zonas,
        ]);
    }
    
    /**
     * @Route("/zonas/new", name="zona_new")
     * @Method("GET")
     * @CheckPermission()
     */
    public function newAction(Request $request) {
        $zona = new Zona();

        $formulario = $this->createForm(
                ZonaType::class, $zona, array('action' => $this->generateUrl('zona_create'), 'method' => 'POST')
        );

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zonas/create", name="zona_create")
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $zona = new Zona();
        $formulario = $this->createForm(
                ZonaType::class, $zona, array('action' => $this->generateUrl('zona_create'),
            'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($zona);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha creado la zona : "'. $zona->getZona() . '" satisfactoriamente.');
            return $this->redirectToRoute('zona_edit', array('_id_zona' => $zona->getIdZona()));
        }

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zonas/edit/{_id_zona}", name="zona_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id_zona) {
        $em = $this->getDoctrine()->getManager();

        $zona = $em->getRepository(Zona::class)->find($_id_zona);

        $formulario = $this->createForm(
                ZonaType::class, $zona, array('action' => $this->generateUrl('zona_update', array('_id_zona' => $_id_zona)),
            'method' => 'PUT')
        );

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zonas/update/{_id_zona}", name="zona_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id_zona) {
        
        $em = $this->getDoctrine()->getManager();
        $zona = $em->getRepository(Zona::class)->find($_id_zona);

        $formulario = $this->createForm(
                ZonaType::class, $zona, array('action' => $this->generateUrl('zona_update', array('_id_zona' => $_id_zona)),
            'method' => 'PUT'));
        
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($zona);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado la zona : "'. $zona->getZona() . '" satisfactoriamente.');
            return $this->redirectToRoute('zona_edit', array('_id_zona' => $_id_zona));
        }

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zonas/delete/{_id_zona}", name="zona_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $_id_zona) {
        $em = $this->getDoctrine()->getManager();
        $zona = $em->getRepository(Zona::class)->find($_id_zona);
        $em->remove($zona);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success','Se ha eliminado la zona : "'. $zona->getZona() . '" satisfactoriamente.');
        return $this->redirectToRoute('zona_index');
    }
    
}
