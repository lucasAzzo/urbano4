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

/**
 * Description of ZonaController
 *
 * @author Lucas
 */
class ZonaController extends Controller {
    
    /**
     * @Route("/zona_index", name="zona_index")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $zonas = $em->getRepository(Zona::class)->findAll();
        
        return $this->render('zona/index.html.twig', [
                    'zonas' => $zonas,
        ]);
    }
    
    /**
     * @Route("/zona_new", name="zona_new")
     * @Method("GET")
     * @Security("is_authenticated()")
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
     * @Route("/zona_create", name="zona_create")
     * @Method("POST")
     * @Security("is_authenticated()")
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
            return $this->redirectToRoute('zona_edit', array('id_zona' => $zona->getIdZona()));
        }

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zona_edit/{id_zona}", name="zona_edit")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction(Request $request, $id_zona) {
        $em = $this->getDoctrine()->getManager();

        $zona = $em->getRepository(Zona::class)->find($id_zona);

        $formulario = $this->createForm(
                ZonaType::class, $zona, array('action' => $this->generateUrl('zona_update', array('id_zona' => $id_zona)),
            'method' => 'PUT')
        );

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zona_update/{id_zona}", name="zona_update")
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id_zona) {
        
        $em = $this->getDoctrine()->getManager();
        $zona = $em->getRepository(Zona::class)->find($id_zona);

        $formulario = $this->createForm(
                ZonaType::class, $zona, array('action' => $this->generateUrl('zona_update', array('id_zona' => $id_zona)),
            'method' => 'PUT'));
        
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($zona);
            $em->flush();
            return $this->redirectToRoute('zona_edit', array('id_zona' => $id_zona));
        }

        return $this->render('zona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/zona_delete/{id_zona}", name="zona_delete")
     * @Security("is_authenticated()")
     */
    public function deleteAction(Request $request, $id_zona) {
        $em = $this->getDoctrine()->getManager();
        $zona = $em->getRepository(Zona::class)->find($id_zona);
        $em->remove($zona);
        $em->flush();
        return $this->redirectToRoute('zona_index');
    }
    
}
