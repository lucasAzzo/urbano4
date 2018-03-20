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
use AppBundle\Entity\Estado;
use AppBundle\Form\EstadoType;
use AppBundle\Annotation\CheckPermission;

/**
 * Description of EstadoController
 *
 * @author Lucas
 */
class EstadoController extends Controller {

    /**
     * @Route("/estados", name="estado_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $estados = $em->getRepository(Estado::class)->findBy([], ['estado' => 'ASC']);

        return $this->render('estado/index.html.twig', [
                    'estados' => $estados,
        ]);
    }

    /**
     * @Route("/estados/new", name="estado_new")
     * @Method("GET")
     * @CheckPermission()
     */
    public function newAction(Request $request) {
        $estado = new Estado();

        $em = $this->getDoctrine()->getManager();
        $estados = $em->getRepository(Estado::class)->findBy([], ['estado' => 'ASC']);

        $formulario = $this->createForm(
                EstadoType::class, $estado, array('action' => $this->generateUrl('estado_create'), 'method' => 'POST')
        );

        return $this->render('estado/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'estados' => $estados
        ]);
    }

    /**
     * @Route("/estados/create", name="estado_create")
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $estados = $em->getRepository(Estado::class)->findBy([], ['estado' => 'ASC']);
        $estado = new Estado();

        $formulario = $this->createForm(
                EstadoType::class, $estado, array('action' => $this->generateUrl('estado_create'),
            'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($estado);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha creado el estado: "'. $estado->getEstado() . '" satisfactoriamente.');
            return $this->redirectToRoute('estado_index');
        }

        return $this->render('estado/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'estados' => $estados
        ]);
    }

    /**
     * @Route("/estados/edit/{id_estado}", name="estado_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $id_estado) {
        $em = $this->getDoctrine()->getManager();

        $estados = $em->getRepository(Estado::class)->findBy([], ['estado' => 'ASC']);
        $estado = $em->getRepository(Estado::class)->find($id_estado);


        $formulario = $this->createForm(
                EstadoType::class, $estado, array('action' => $this->generateUrl('estado_update', array('id_estado' => $id_estado)),
            'method' => 'PUT')
        );

        return $this->render('estado/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'estados' => $estados
        ]);
    }

    /**
     * @Route("/estados/update/{id_estado}", name="estado_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $id_estado) {

        $em = $this->getDoctrine()->getManager();

        $estados = $em->getRepository(Estado::class)->findBy([], ['estado' => 'ASC']);
        $estado = $em->getRepository(Estado::class)->find($id_estado);

        $formulario = $this->createForm(
                EstadoType::class, $estado, array('action' => $this->generateUrl('estado_update', array('id_estado' => $id_estado)),
            'method' => 'PUT'));

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($estado);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado el estado: "'. $estado->getEstado() . '" satisfactoriamente.');
            return $this->redirectToRoute('estado_index');
        }

        return $this->render('estado/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'estados' => $estados
        ]);
    }

    /**
     * @Route("/estados/delete/{id_estado}", name="estado_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $id_estado) {

        $em = $this->getDoctrine()->getManager();
        $estado = $em->getRepository(Estado::class)->find($id_estado);

        $em->remove($estado);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success','Se ha eliminado el estado: "'. $estado->getEstado() . '" satisfactoriamente.');
        return $this->redirectToRoute('estado_index');

    }

}
