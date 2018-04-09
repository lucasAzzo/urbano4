<?php

namespace AppBundle\EventListener;

use AppBundle\Annotation\CheckPermission;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

/**
 * Description of OwnAnnotationListener
 *
 * @author Lucas
 */
class CheckPermissionListener {
    
    private $reader;
    
    private $container;

    
    public function __construct(Reader $reader, ContainerInterface $container = null)
    {
        $this->reader = $reader;
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controllers = $event->getController())) {
            return;
        }

        $request = $event->getRequest();
        //$content = $request->getContent();

        list($controller, $methodName) = $controllers;

        $reflectionClass = new \ReflectionClass($controller);
        $classAnnotation = $this->reader->getClassAnnotation($reflectionClass, CheckPermission::class);

        $reflectionObject = new \ReflectionObject($controller);
        $reflectionMethod = $reflectionObject->getMethod($methodName);
        $methodAnnotation = $this->reader->getMethodAnnotation($reflectionMethod, CheckPermission::class);
        
        if (!($classAnnotation || $methodAnnotation)) {
            return;
        }

        $security = $this->container->get('security.authorization_checker');
        $em = $this->container->get('doctrine.orm.entity_manager');
        
        $parametros = $request->get('_route_params');
      
        foreach ($parametros as $key => $parametro) {
            if (substr($key, 0,1) == '_') {
                unset($parametro);
            }
        }
        
        if (empty($parametros)) {
            $route = $em->getRepository('AppBundle:Route')->findOneBy(['name' => $request->get('_route')]);
        } else {
            $routes = $em->getRepository('AppBundle:Route')->findBy(['name' => $request->get('_route')]);
            $route;
            
            foreach ($routes as $ruta) {
                if ($ruta->getParametro() == $parametros) {
                    $route = $ruta;
                }
            }
        }
        
        if (empty($route)) {
            return;
        }
        
        foreach ($route->getRoles() as $rol) {
            if ($security->isGranted($rol->getRole())) {
                return;
            }
            while (!empty($rol->getIdRolePadre())) {
                if ($security->isGranted($rol->getIdRolePadre()->getRole())) {
                    return;
                }
            }
        }
        
        throw new AccessDeniedException('NO TIENE PERMISO PARA INGRESAR A ESTA OPERACIÓN.');
        
    }
    
}
