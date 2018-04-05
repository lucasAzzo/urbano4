<?php

namespace AppBundle\Ajax;

use \Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of Consultas
 *
 * @author Lucas
 */
class Consultas extends Controller {

    /**
     * @Route("/consulta_shippers", name="consulta_shippers")
     * 
     */
    public function shippers(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $shippers = $em->getRepository('AppBundle:Shipper')->findByArrayResult();

        return new JsonResponse(array('data' => $shippers));
    }

}
