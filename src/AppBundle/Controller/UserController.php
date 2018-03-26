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
use AppBundle\Annotation\CheckPermission;

class UserController extends Controller
{

    /**
    * @Route("/users", name="users_index")
    * @Method("GET")
    * @CheckPermission()
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
     * @CheckPermission()
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
     * @CheckPermission()
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
            $user->setEnabled(1);
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
     * @Route("/users/edit/{_id}", name="users_edit" )
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction($_id)
    {
        $pw_required = false;
        $em    = $this->getDoctrine()->getManager();
        $user  = $em->getRepository(User::class)->find($_id);
        $roles = $em->getRepository(Role::class)->findAll();

        $form  = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_update', array(
                '_id' => $_id,
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
     * @Route("/users/update/{_id}", name="users_update" )
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $_id)
    {
        $em   = $this->getDoctrine()->getManager();
        $user  = $em->getRepository(User::class)->find($_id);

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
            '_id' => $_id,
        )); 
    }

    /**
     * @Route("/users/delete/{_id}", name="users_delete" )
     * @Method("DELETE")
     * @CheckPermission()
     */
    public function deleteAction($_id)
    {
        $user = new User();
        $em   = $this->getDoctrine()->getManager();
        $user  = $em->getRepository(User::class)->find($_id);

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
