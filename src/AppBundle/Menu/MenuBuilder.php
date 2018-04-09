<?php

namespace AppBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Knp\Menu\FactoryInterface;

class MenuBuilder /* extends \Twig_Extension */ {

    protected $container;
    protected $factory;

    public function __construct(ContainerInterface $container = null, FactoryInterface $factory) {
        $this->container = $container;
        $this->factory = $factory;
    }

    public function createMainMenu() {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $menu = $this->factory->createItem('root');

        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null], ['orden' => 'ASC']);

        foreach ($modulos as $modulo) {
            if ($this->tieneHijoConRol($modulo)) {
                $menu->addChild($modulo->getNombre(), array('route' => '', 'attributes' => array('icono' => $modulo->getIcono())));

                foreach ($modulo->getHijos() as $submodulo) {
                    if ($this->tieneRol($submodulo)) {
                        if (empty($submodulo->getIdRoute())) {
                            $menu[$modulo->getNombre()]->addChild($submodulo->getNombre(), array('route' => '', 'routeParameters' => array()));
                        } else {
                            $menu[$modulo->getNombre()]->addChild($submodulo->getNombre(), array('route' => $submodulo->getIdRoute()->getName(), 'routeParameters' => $this->obtenerParametros($submodulo)));
                        }
                        foreach ($submodulo->getHijos() as $operacion) {
                            if ($this->tieneRol($operacion)) {
                                if (empty($operacion->getIdRoute())) {
                                    $menu[$modulo->getNombre()][$submodulo->getNombre()]->addChild($operacion->getNombre(), array('route' => '', 'routeParameters' => array()));
                                } else {
                                    $menu[$modulo->getNombre()][$submodulo->getNombre()]->addChild($operacion->getNombre(), array('route' => $operacion->getIdRoute()->getName(), 'routeParameters' => $this->obtenerParametros($operacion)));
                                }
                            }
                        }
                    }
                }
            }
        }

        return $menu;
    }

    protected function tieneRol($menu) {

        if (empty($menu->getIdRoute())) {
            return true;
        }

        $security = $this->container->get('security.authorization_checker');
        foreach ($menu->getIdRoute()->getRoles() as $rol) {
            if ($security->isGranted($rol->getRole())) {
                return true;
            }
            $aux = $rol->getIdRolePadre();
            while (!empty($aux)) {
                if ($security->isGranted($aux->getRole())) {
                    return true;
                }
                $aux = $aux->getIdRolePadre();
            }
        }
        return false;
    }

    protected function obtenerParametros($menu) {

        $parametros = $menu->getIdRoute()->getParametro();

        $resultado = array();

        if ($parametros) {
            foreach ($parametros as $key => $parametro) {
                $resultado[$key] = $parametro;
            }
        }
        return $resultado;
    }

    protected function tieneHijoConRol($menu) {

        foreach ($menu->getHijos() as $hijo) {
            if ($this->tieneRol($hijo)) {
                return true;
            }
        }

        return false;
    }

//    public function getFunctions()
//    {
//        return array(
//            'createMainMenu' => new \Twig_Function_Method($this, 'createMainMenu', array('is_safe' => array('html')))
//        );
//    }
}
