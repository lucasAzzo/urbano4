<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UploadFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Upload;

class UploadController extends Controller
{
    /**
     * @Route("/upload", name="Upload")
     * @Security("is_authenticated()")
     */
    public function indexAction(Request $request)
    {
     //   $form = $this->formFactory->Createform();




        return $this->render('default/upload.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/upload_new", name="upload_new")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function newAction(Request $request) {
        $upload = new Upload();
        $formulario = $this->createForm(
            UploadFormType::class, $upload, array('action' => $this->generateUrl('upload_create'), 'method' => 'POST')
        );
        return $this->render('upload/new_upload.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/upload_create", name="upload_create")
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $upload = new Upload();
        $formulario = $this->createForm(
            UploadFormType::class, $upload, array('action' => $this->generateUrl('upload_create'),
                'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $em->persist($upload);
            $em->flush();
            return $this->redirectToRoute('upload', array('id_upload' => $upload->getId()));
        }

        return $this->render('upload/new_upload.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }


}
