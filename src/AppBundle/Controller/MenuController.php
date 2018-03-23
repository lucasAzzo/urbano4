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
use AppBundle\Annotation\CheckPermission;

/**
 * Description of MenuController
 *
 * @author Lucas
 */
class MenuController extends Controller {
    
    /**
     * @Route("/menus", name="menu_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        
        return $this->render('menu/index.html.twig', [
                    'modulos' => $modulos,
        ]);
    }
    
    /**
     * @Route("/menus/new", name="menu_new")
     * @Method("GET")
     * @CheckPermission()
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
     * @Route("/menus/create", name="menu_create")
     * @Method("POST")
     * @CheckPermission()
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
            return $this->redirectToRoute('menu_index');
        }

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }
    
    /**
     * @Route("/menus/edit/{_id_menu}", name="menu_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id_menu) {
        $em = $this->getDoctrine()->getManager();
        
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        $menu = $em->getRepository(Menu::class)->find($_id_menu);
        

        $formulario = $this->createForm(
                MenuType::class, $menu, array('action' => $this->generateUrl('menu_update', array('_id_menu' => $_id_menu)),
            'method' => 'PUT')
        );

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }

    /**
     * @Route("/menus/update/{_id_menu}", name="menu_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id_menu) {
        
        $em = $this->getDoctrine()->getManager();
        
        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        $menu = $em->getRepository('AppBundle:Menu')->find($_id_menu);

        $formulario = $this->createForm(
                MenuType::class, $menu, array('action' => $this->generateUrl('menu_update', array('_id_menu' => $_id_menu)),
            'method' => 'PUT'));
        
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('menu_index');
        }

        return $this->render('menu/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
                    'modulos' => $modulos
        ]);
    }

    /**
     * @Route("/menus/delete/{_id_menu}", name="menu_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $_id_menu) {
        
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('AppBundle:Menu')->find($_id_menu);

        if (empty($menu->getHijos()->first())) {
            $em->remove($menu);
            $em->flush();
            return $this->redirectToRoute('menu_index');
        }
        
        $request->getSession()->getFlashBag()->add('error','No se puede eliminar la opción de menú "'. $menu->getNombre() . '" ya que posee hijos');
        return $this->redirectToRoute('menu_index');
       
    }
    
}
