<?php

namespace AppBundle\Api;

use \Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of Api
 *
 * @author Lucas
 */
class ApiShipperController extends Controller {

    /**
     * @Route("/api", name="api")
     * 
     */
    public function shippers(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $shippers = $em->getRepository('AppBundle:Shipper')->findByArrayResult();

        return new JsonResponse(array('data' => $shippers));
    }
    
    
    /**
     * @Route("/consulta_sucursales", name="consulta_sucursales")
     * 
     */
    public function sucursales(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $sucursales = $em->getRepository('AppBundle:Sucursal')->findByArrayResult();

        return new JsonResponse(array('data' => $sucursales));
    }
    
    
    /**
     * @Route("/consulta_productos", name="consulta_productos")
     * 
     */
    public function productos(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('AppBundle:Producto')->findByArrayResult();

        return new JsonResponse(array('data' => $productos));
    }
    
    
    /**
     * @Route("/consulta_rutas", name="consulta_rutas")
     * 
     */
    public function rutas(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $routes = $em->getRepository('AppBundle:Route')->findBy([],['path' => 'ASC']);
        
        $resultado = array();
        foreach ($routes as $route) {
            $id = $route->getIdRoute();
            $path = $route->getPath();
            $name = $route->getName();
            
            $resultado[] = array('id' => $id, 'path' => $path, 'name' => $name);
        }
        
        return new JsonResponse(array('data' => $resultado));
    }

}
