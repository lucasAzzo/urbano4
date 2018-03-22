<?php

namespace AppBundle\Extensions\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissionHelper
 *
 * @author Lucas
 */
class PermissionHelper extends \Twig_Extension {

    private $container;

    public function __construct(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('has_permission', array($this, 'hasPermission')),
        );
    }

    public function hasPermission($ruta, $parametros = null) {

        $security = $this->container->get('security.authorization_checker');
        $em = $this->container->get('doctrine.orm.entity_manager');

        if (is_null($parametros)) {
            $route = $em->getRepository('AppBundle:Route')->findOneBy(['name' => $ruta]);
        } else {
            $routes = $em->getRepository('AppBundle:Route')->findBy(['name' => $ruta]);
            $route;

            foreach ($routes as $ruta) {
                if ($ruta->getParametro() == $parametros) {
                    $route = $ruta;
                }
            }
        }

        foreach ($route->getRoles() as $rol) {
            if ($security->isGranted($rol->getRole())) {
                return true;
            }
        }

        return false;
    }

    public function getName() {
        return 'permission_helper';
    }

}
