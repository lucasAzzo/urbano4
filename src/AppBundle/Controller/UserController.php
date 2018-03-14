<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use AppBundle\Form\UserType;

class UserController extends Controller
{

    /**
    * @Route("/users", name="users_index")
    * @Method("GET")
    * @Security("is_authenticated() && has_role('ROLE_ADMIN')")
    */
    public function indexAction(Request $request)
    {
        $em    = $this->getDoctrine();
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', 
            array(
                'users' => $users,
            )
        );
    }

    /**
     * @Route("/users/new", name="users_new" )
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function newAction()
    {
        $pw_required = true;
        $user  = new User();
        
        $em    = $this->getDoctrine()->getManager();
        $roles = $em->getRepository(Role::class)->findAll();

        $form  = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_create'),
            'method' => 'POST',
        ));

        return $this->render('user/new_edit.html.twig', array(
            'user'  => $user,
            'roles' => $roles,
            'form'  => $form->createView(),
            'pw_required' => $pw_required,
        ));
    }

    /**
     * @Route("/users/create", name="users_create" )
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request)
    {
        $user = new User();
        $em   = $this->getDoctrine()->getManager();
        $roles = $request->request->get('roles');
        
        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_create'),
            'method' => 'POST',
        ));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && is_array($roles) && sizeof($roles) > 0) {
            $user->setRoles($roles);
            $em->persist($user);
            $em->flush();
            $users = $em->getRepository(User::class)->findAll();

            return $this->redirectToRoute('users_index', array(
                'users' => $users,
            ));
        }

        $pw_required = true;
        $roles = $em->getRepository(User::class)->find($id);
        return $this->render('user/new_edit.html.twig', array(
            'user'  => $user,
            'roles' => $roles,
            'form'  => $form->createView(),
            'pw_required' => $pw_required,
        ));
    }

    /**
     * @Route("/users/edit/{id}", name="users_edit" )
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function editAction($id)
    {
        $pw_required = false;
        $em    = $this->getDoctrine()->getManager();
        $user  = $em->getRepository(User::class)->find($id);
        $roles = $em->getRepository(Role::class)->findAll();

        $form  = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_update', array(
                'id' => $id,
            )),
            'method' => 'PUT',
            'pw_required' => $pw_required,
        ));

        return $this->render('user/new_edit.html.twig', array(
            'user'  => $user,
            'roles' => $roles,
            'form'  => $form->createView(),
            'pw_required' => $pw_required,
        ));
    }

    /**
     * @Route("/users/update/{id}", name="users_update" )
     * @Method("PUT")
     * @Security("is_authenticated()")
     */
    public function updateAction(Request $request, $id)
    {
        $em   = $this->getDoctrine()->getManager();
        $user  = $em->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_update', array(
                'id' => $id,
            )),
            'method' => 'PUT',
        ));
        $query = $em->createQueryBuilder()->select('r.role')->from('AppBundle:Role', 'r');
        $roles_db = $query->getQuery()->getArrayResult();
        $roles = $request->request->get('roles');

        $roles_db = array_map(function ($value)
        {
            return($value['role']);
        }, 
        $roles_db);
        
        foreach ($roles as $key => $role) {
            if (!in_array($role, $roles_db)) {
                unset($roles[$key]);
            }
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && is_array($roles) && sizeof($roles) > 0) {
            $user->setRoles($roles);
            $em->persist($user);
            $em->flush();
            $users = $em->getRepository(User::class)->findAll();
            return $this->redirectToRoute('users_index', array(
                'users' => $users,
            ));
        }

        return $this->redirectToRoute('users_edit', array(
            'id' => $id,
        )); 
    }

    /**
     * @Route("/users/delete/{id}", name="users_delete" )
     * @Method("DELETE")
     * @Security("is_authenticated()")
     */
    public function deleteAction($id)
    {
        $user = new User();
        $em   = $this->getDoctrine()->getManager();
        $user  = $em->getRepository(User::class)->find($id);

        if ($user) {
            $em->remove($user);
            $em->flush();
        }

        $users = $em->getRepository(User::class)->findAll();
        return $this->redirectToRoute('users_index', array(
            'users' => $users,
        ));
    }

}
