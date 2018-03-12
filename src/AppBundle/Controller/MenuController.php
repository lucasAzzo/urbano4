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
use AppBundle\Entity\Menu;
use AppBundle\Form\MenuType;

/**
 * Description of MenuController
 *
 * @author Lucas
 */
class MenuController extends Controller {
    
    /**
     * @Route("/menu_index", name="menu_index")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        
        return $this->render('menu/index.html.twig', [
                    'modulos' => $modulos,
        ]);
    }
    
    /**
     * @Route("/menu_new", name="menu_new")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function newAction(Request $request) {
        $menu = new Menu();
        
        $em = $this->getDoctrine()->getManager();
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);

        $formulario = $this->createForm(
                MenuType::class, $menu, array('action' => $this->generateUrl('menu_create'), 'method' => 'POST')
        );

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }
    
    /**
     * @Route("/menu_create", name="menu_create")
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        $menu = new Menu();
        
        $formulario = $this->createForm(
                MenuType::class, $menu, array('action' => $this->generateUrl('menu_create'),
            'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('menu_edit', array('id_menu' => $menu->getIdMenu()));
        }

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }
    
    /**
     * @Route("/menu_edit/{id_menu}", name="menu_edit")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction(Request $request, $id_menu) {
        $em = $this->getDoctrine()->getManager();
        
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        $menu = $em->getRepository(Menu::class)->find($id_menu);
        

        $formulario = $this->createForm(
                MenuType::class, $menu, array('action' => $this->generateUrl('menu_update', array('id_menu' => $id_menu)),
            'method' => 'PUT')
        );

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }

    /**
     * @Route("/menu_update/{id_menu}", name="menu_update")
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id_menu) {
        
        $em = $this->getDoctrine()->getManager();
        
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        $menu = $em->getRepository('AppBundle:Menu')->find($id_menu);

        $formulario = $this->createForm(
                MenuType::class, $menu, array('action' => $this->generateUrl('menu_update', array('id_menu' => $id_menu)),
            'method' => 'PUT'));
        
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('menu_edit', array('id_menu' => $id_menu));
        }

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }

    /**
     * @Route("/menu_delete/{id_menu}", name="menu_delete")
     * @Security("is_authenticated()")
     */
    public function deleteAction(Request $request, $id_menu) {
        
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('AppBundle:Menu')->find($id_menu);

        if (empty($menu->getHijos()->first())) {
            $em->remove($menu);
            $em->flush();
            return $this->redirectToRoute('menu_index');
        }
        
        $request->getSession()->getFlashBag()->add('error','No se puede eliminar la opción de menú "'. $menu->getNombre() . '" ya que posee hijos');
        return $this->redirectToRoute('menu_index');
       
    }
    
}
