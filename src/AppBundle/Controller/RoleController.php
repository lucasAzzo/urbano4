<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Role;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\RoleType;

class RoleController extends Controller
{
    /**
     * @Route("/roles", name="roles_index")
     * @Method("GET")
     * @Security("is_authenticated()")
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
     * @Security("is_authenticated()")
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
     * @Security("is_authenticated()")
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
     * @Route("/roles/edit/{id}", name="roles_edit" )
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine();
        $role = $em->getRepository(Role::class)->find($id);
        if ($role) {
            $form = $this->createForm(RoleType::class, $role, array(
                'action' => $this->generateUrl('roles_update', array(
                    'id' => $id,
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
     * @Route("/roles/update/{id}", name="roles_update" )
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository(Role::class)->find($id);
        $form = $this->createForm(RoleType::class, $role, array(
            'action' => $this->generateUrl('roles_update', array(
                    'id' => $id,
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
     * @Route("/roles/delete/{id}", name="roles_delete" )
     * @Method("DELETE")
     * @Security("is_authenticated()")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository(Role::class)->find($id);

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
