<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class UserController extends Controller
{

    /**
    * @Route("/users", name="users_index")
    * @Method("GET")
    * @Security("is_authenticated()")
    */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine();
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
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_create'),
            'method' => 'POST',
        ));

        return $this->render('user/new_edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/users/create", name="users_create" )
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('users_create'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();
            $users = $em->getRepository(User::class)->findAll();
            return $this->redirectToRoute('users_index', array(
                'users' => $users,
            ));
        }

        return $this->render('user/new_edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}
