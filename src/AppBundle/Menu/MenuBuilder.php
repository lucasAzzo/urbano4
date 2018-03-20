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

        /** @var $router \Symfony\Component\Routing\Router */
        $router = $this->container->get('router');
        /** @var $collection \Symfony\Component\Routing\RouteCollection */
        $collection = $router->getRouteCollection();
        $allRoutes = $collection->all();

        dump($allRoutes);
        die;


        $em = $this->container->get('doctrine.orm.entity_manager');

        $menu = $this->factory->createItem('root');

        $modulos = $em->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null], ['orden' => 'ASC']);

        foreach ($modulos as $modulo) {
            if ($this->tieneRol($modulo)) {
                $menu->addChild($modulo->getNombre(), array('route' => '', 'attributes' => array('icono' => $modulo->getIcono())));

                foreach ($modulo->getHijos() as $submodulo) {
                    if ($this->tieneRol($submodulo)) {
                        $menu[$modulo->getNombre()]->addChild($submodulo->getNombre(), array('route' => $submodulo->getIdRoute()->getName(), 'routeParameters' => $this->obtenerParametros($submodulo)));

                        foreach ($submodulo->getHijos() as $operacion) {
                            if ($this->tieneRol($operacion)) {
                                $menu[$modulo->getNombre()][$submodulo->getNombre()]->addChild($operacion->getNombre(), array('route' => $operacion->getIdRoute()->getName(), 'routeParameters' => $this->obtenerParametros($operacion)));
                            }
                        }
                    }
                }
            }
        }

        return $menu;
    }

    protected function tieneRol($menu) {

        if (is_null($menu->getIdMenuPadre())) {
            return true;
        }

        $security = $this->container->get('security.authorization_checker');
        foreach ($menu->getIdRoute()->getRoles() as $rol) {
            if ($security->isGranted($rol->getRole())) {
                return true;
            }
        }
        return false;
    }

    protected function obtenerParametros($menu) {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $parametros = $em->getRepository('AppBundle:Param')->findBy(['idRoute' => $menu->getIdRoute(), 'idMenu' => $menu]);

        $resultado = array();

        foreach ($parametros as $parametro) {
            $resultado[$parametro->getName()] = $parametro->getValue();
        }

        return $resultado;
    }

//    public function getFunctions()
//    {
//        return array(
//            'createMainMenu' => new \Twig_Function_Method($this, 'createMainMenu', array('is_safe' => array('html')))
//        );
//    }
}
