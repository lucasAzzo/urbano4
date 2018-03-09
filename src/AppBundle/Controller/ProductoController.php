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
use AppBundle\Entity\Producto;
use AppBundle\Form\ProductoType;

/**
 * Description of ProductoController
 *
 * @author Lucas
 */
class ProductoController extends Controller {
    
    /**
     * @Route("/producto_index", name="producto_index")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Producto::class)->findAll();
        
        return $this->render('producto/index.html.twig', [
                    'productos' => $productos,
        ]);
    }
    
    /**
     * @Route("/producto_new", name="producto_new")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function newAction(Request $request) {
        $producto = new Producto();

        $formulario = $this->createForm(
                ProductoType::class, $producto, array('action' => $this->generateUrl('producto_create'), 'method' => 'POST')
        );

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/producto_create", name="producto_create")
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $producto = new Producto();
        $formulario = $this->createForm(
                ProductoType::class, $producto, array('action' => $this->generateUrl('producto_create'),
            'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('producto_edit', array('id_producto' => $producto->getIdProducto()));
        }

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/producto_edit/{id_producto}", name="producto_edit")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction(Request $request, $id_producto) {
        $em = $this->getDoctrine()->getManager();

        $producto = $em->getRepository(Producto::class)->find($id_producto);

        $formulario = $this->createForm(
                ProductoType::class, $producto, array('action' => $this->generateUrl('producto_update', array('id_producto' => $id_producto)),
            'method' => 'PUT')
        );

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/producto_update/{id_producto}", name="producto_update")
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id_producto) {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Producto::class)->find($id_producto);

        $formulario = $this->createForm(
                ProductoType::class, $producto, array('action' => $this->generateUrl('producto_update', array('id_producto' => $id_producto)),
            'method' => 'PUT'));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('producto_edit', array('id_producto' => $id_producto));
        }

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/producto_delete/{id_producto}", name="producto_delete")
     * @Security("is_authenticated()")
     */
    public function deleteAction(Request $request, $id_producto) {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Producto::class)->find($id_producto);
        $em->remove($producto);
        $em->flush();
        return $this->redirectToRoute('producto_index');
    }
    
}
