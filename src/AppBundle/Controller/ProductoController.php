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
use AppBundle\Annotation\CheckPermission;

/**
 * Description of ProductoController
 *
 * @author Lucas
 */
class ProductoController extends Controller {
    
    /**
     * @Route("/productos", name="producto_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Producto::class)->findAll();
        
        return $this->render('producto/index.html.twig', [
                    'productos' => $productos,
        ]);
    }
    
    /**
     * @Route("/productos/new", name="producto_new")
     * @Method("GET")
     * @CheckPermission()
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
     * @Route("/productos/create", name="producto_create")
     * @Method("POST")
     * @CheckPermission()
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
            return $this->redirectToRoute('producto_edit', array('_id_producto' => $producto->getIdProducto()));
        }

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/productos/edit/{_id_producto}", name="producto_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id_producto) {
        $em = $this->getDoctrine()->getManager();

        $producto = $em->getRepository(Producto::class)->find($_id_producto);

        $formulario = $this->createForm(
                ProductoType::class, $producto, array('action' => $this->generateUrl('producto_update', array('_id_producto' => $_id_producto)),
            'method' => 'PUT')
        );

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/productos/update/{_id_producto}", name="producto_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id_producto) {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Producto::class)->find($_id_producto);

        $formulario = $this->createForm(
                ProductoType::class, $producto, array('action' => $this->generateUrl('producto_update', array('_id_producto' => $_id_producto)),
            'method' => 'PUT'));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('producto_edit', array('_id_producto' => $_id_producto));
        }

        return $this->render('producto/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/productos/delete/{_id_producto}", name="producto_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $_id_producto) {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Producto::class)->find($_id_producto);
        $em->remove($producto);
        $em->flush();
        return $this->redirectToRoute('producto_index');
    }
    
}
