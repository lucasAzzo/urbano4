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
        $modulos = $em->getRepository('AppBundle:Modulo')->findBy([],['orden' => 'ASC']);
        
        return $this->render('menu/index.html.twig', [
                    'modulos' => $modulos,
        ]);
    }
    
}
