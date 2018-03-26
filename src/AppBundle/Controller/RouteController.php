<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\RouteType;
use AppBundle\Annotation\CheckPermission;

/**
 * Description of RouteController
 *
 * @author Lucas
 */
class RouteController extends Controller {

    /**
     * @Route("/routes", name="route_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository('AppBundle:Role')->findBy([], ['role' => 'ASC']);

        return $this->render('route/index.html.twig', [
                    'roles' => $roles,
        ]);
    }

    /**
     * @Route("/routes/edit/{_id_role}", name="route_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id_role) {

        $em = $this->getDoctrine()->getManager();

        $rol = $em->getRepository('AppBundle:Role')->find($_id_role);

        $id_checks = array();
        foreach ($rol->getRoutes() as $route) {
            $id_checks[] = $route->getIdRoute();
        }

        $routes = $em->getRepository('AppBundle:Route')->findAll();

        return $this->render('route/new_edit.html.twig', [
                    'rol' => $rol,
                    'routes' => $routes,
                    'id_checks' => $id_checks,
        ]);
    }

    /**
     * @Route("/routes/update/{_id_role}", name="route_update")
     * @Method("POST")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id_role) {

        /* rutas checkeadas nuevas */
        $rutas_nuevas = $request->get('rutas');

        $em = $this->getDoctrine()->getManager();

        /* @var $rol AppBundle\Entity\Role */
        $rol = $em->getRepository('AppBundle:Role')->find($_id_role);

        /* rutas que tengo hasta el momento */
        $rutas_anteriores = $rol->getRoutes();

        if (is_null($rutas_nuevas)) {
            foreach ($rol->getRoutes() as $route) {
                $rol->removeRoute($route);
            }
        } else {
            /* las rutas que antes estaban y ahora no */
            foreach ($rutas_anteriores as $ruta_anterior) {
                if (!in_array($ruta_anterior->getIdRoute(), $rutas_nuevas)) {
                    $rol->removeRoute($ruta_anterior);
                }
            }
        }

        $rutas_anteriores_arr = array();
        foreach ($rutas_anteriores as $ruta_anterior) {
            $rutas_anteriores_arr[] = $ruta_anterior->getIdRoute();
        }

        if (!is_null($rutas_nuevas)) {
            /* las rutas nuevas que antes no estaban */
            foreach ($rutas_nuevas as $ruta_nueva) {
                $r_n = $em->getRepository('AppBundle:Route')->find($ruta_nueva);
                if (!in_array($r_n->getIdRoute(), $rutas_anteriores_arr)) {
                    $rol->addRoute($r_n);
                }
            }
        }

        $em->persist($rol);
        $em->flush();

        $id_checks = array();
        foreach ($rol->getRoutes() as $route) {
            $id_checks[] = $route->getIdRoute();
        }

        $routes = $em->getRepository('AppBundle:Route')->findAll();

        $request->getSession()->getFlashBag()->add('success', 'Se han guardado los cambios satisfactoriamente.');

        return $this->redirectToRoute('route_edit', array('_id_role' => $_id_role));

    }

}
