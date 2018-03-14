<?php

namespace AppBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Knp\Menu\FactoryInterface;

class MenuBuilder /*extends \Twig_Extension*/ {

    protected $container;
    protected $factory;

    public function __construct(ContainerInterface $container = null, FactoryInterface $factory)
    {
        $this->container = $container;
        $this->factory = $factory;
    }

    public function createMainMenu() {

        $menu = $this->factory->createItem('root');
        
        $modulos = $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Menu')->findBy(['idMenuPadre' => null],['orden' => 'ASC']);
        
//        return $this->container->get('templating')->render(
//                        'menu_izquierdo.html.twig', array('modulos' => $modulos)
//        );
        
        
        foreach ($modulos as $modulo) {
            $menu->addChild($modulo->getNombre(), array('route' => '', 'attibutes' => array('route' => $modulo->getPath(), 'params' => eval( 'return ' . $modulo->getParametro() . ';'))));
            
            foreach ($modulo->getHijos() as $submodulo) {
                $menu[$modulo->getNombre()]->addChild($submodulo->getNombre(), array('attributes' => array('route' => $submodulo->getPath(), 'params' => eval( 'return ' . $submodulo->getParametro() . ';')),'route' => $submodulo->getPath(),'routeParameters' => eval("return " . $submodulo->getParametro() . ";")));
                
                foreach ($submodulo->getHijos() as $operacion) {
                    $menu[$modulo->getNombre()][$submodulo->getNombre()]->addChild($operacion->getNombre(), array('attributes' => array('route' => $operacion->getPath(), 'params' => eval( 'return ' . $operacion->getParametro() . ';')),'route' => $operacion->getPath(), 'routeParameters' => eval("return " . $operacion->getParametro() . ";")));
                }
            }
        }
        
        return $menu;
        
    }
    
//    public function getFunctions()
//    {
//        return array(
//            'createMainMenu' => new \Twig_Function_Method($this, 'createMainMenu', array('is_safe' => array('html')))
//        );
//    }

}
