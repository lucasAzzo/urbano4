<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Role;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\RoleType;
use AppBundle\Annotation\CheckPermission;

class RoleController extends Controller
{
    /**
     * @Route("/roles", name="roles_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();
        $roles = $em->getRepository(Role::class)->findAll();
        return $this->render('role/index.html.twig', array(
            'roles' => $roles,
        ));
    }

    /**
     * @Route("/roles/new", name="roles_new" )
     * @Method("GET")
     * @CheckPermission()
     */
    public function newAction()
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role, array(
            'action' => $this->generateUrl('roles_create'),
            'method' => 'POST',
        ));

        return $this->render('role/new_edit.html.twig', array(
            'role' => $role,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/roles/create", name="roles_create" )
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role, array(
            'action' => $this->generateUrl('roles_create'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($role);
            $em->flush();
            $roles = $em->getRepository(Role::class)->findAll();
            return $this->redirectToRoute('roles_index', array(
                'roles' => $roles,
            ));
        }

        return $this->render('role/new_edit.html.twig', array(
            'role' => $role,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/roles/edit/{_id}", name="roles_edit" )
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $_id)
    {
        $em = $this->getDoctrine();
        $role = $em->getRepository(Role::class)->find($_id);
        if ($role) {
            $form = $this->createForm(RoleType::class, $role, array(
                'action' => $this->generateUrl('roles_update', array(
                    '_id' => $_id,
                )),
                'method' => 'PUT',
            ));

            return $this->render('role/new_edit.html.twig', array(
                'role' => $role,
                'form' => $form->createView(),
            ));
        }

        $roles = $em->getRepository(Role::class)->findAll();
        return $this->redirectToRoute('roles_index', array(
            'roles' => $roles,
        ));
    }

    /**
     * @Route("/roles/update/{_id}", name="roles_update" )
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id)
    {
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository(Role::class)->find($_id);
        $form = $this->createForm(RoleType::class, $role, array(
            'action' => $this->generateUrl('roles_update', array(
                    '_id' => $_id,
                )),
            'method' => 'PUT',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($role);
            $em->flush();
            $roles = $em->getRepository(Role::class)->findAll();
            return $this->redirectToRoute('roles_index', array(
                'roles' => $roles,
            ));
        }

        return $this->render('role/new_edit.html.twig', array(
            'role' => $role,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/roles/delete/{_id}", name="roles_delete" )
     * @Method("DELETE")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $_id)
    {
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository(Role::class)->find($_id);

        if ($role) {
            $em->remove($role);
            $em->flush();
        }

        $roles = $em->getRepository(Role::class)->findAll();
        return $this->redirectToRoute('roles_index', array(
            'roles' => $roles,
        ));
    }

}
