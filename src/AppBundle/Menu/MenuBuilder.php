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
            if ($this->tieneRol($modulo)) {
                $menu->addChild($modulo->getNombre(), array('route' => '', 'attributes' => array('icono' => $modulo->getIcono(), 'route' => $modulo->getPath(), 'params' => eval('return ' . $modulo->getParametro() . ';'))));

                foreach ($modulo->getHijos() as $submodulo) {
                    if ($this->tieneRol($submodulo)) {
                        $menu[$modulo->getNombre()]->addChild($submodulo->getNombre(), array('attributes' => array('route' => $submodulo->getPath(), 'params' => eval('return ' . $submodulo->getParametro() . ';')), 'route' => $submodulo->getPath(), 'routeParameters' => eval("return " . $submodulo->getParametro() . ";")));

                        foreach ($submodulo->getHijos() as $operacion) {
                            if ($this->tieneRol($operacion)) {
                                $menu[$modulo->getNombre()][$submodulo->getNombre()]->addChild($operacion->getNombre(), array('attributes' => array('route' => $operacion->getPath(), 'params' => eval('return ' . $operacion->getParametro() . ';')), 'route' => $operacion->getPath(), 'routeParameters' => eval("return " . $operacion->getParametro() . ";")));
                            }
                        }
                    }
                }
            }
        }

        return $menu;
    }

    protected function tieneRol($menu) {

        $security = $this->container->get('security.authorization_checker');
        foreach ($menu->getRoles() as $rol) {
            if ($security->isGranted($rol->getRole())) {
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
