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
        
        $modulo = $em->getRepository('AppBundle:Menu')->findOneBy(['path' => $request->get('_route')]);
        
        if (empty($modulo)) {
            return;
        }
        
        foreach ($modulo->getRoles() as $rol) {
            if ($security->isGranted($rol->getRole())) {
                return;
            }
        }
        
        throw new AccessDeniedException('');
        
    }
    
}
