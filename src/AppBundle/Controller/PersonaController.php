<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Persona;
use AppBundle\Entity\PersonaDocumento;
use AppBundle\Entity\PersonaIdioma;
use AppBundle\Entity\PersonaDomicilio;
use AppBundle\Entity\PersonaContacto;
use AppBundle\Entity\PersonaCategoria;
use AppBundle\Form\PersonaType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Annotation\CheckPermission;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * Description of PersonaController
 *
 * @author Lucas
 */
class PersonaController extends Controller {

    /**
     * @Route("/persona_index/{categoria}", name="persona_index")
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request, $categoria) {

        $em = $this->getDoctrine()->getManager();
        
        $categoria_ = $em->getRepository('AppBundle:Categoria')->find($categoria);
        $this->get("session")->set('titulo_operacion', $categoria_->getCategoria());
        
        $this->get("session")->set('categoria', $categoria);
        
        $personas = $em->getRepository('AppBundle:Persona')->findByCategoria($this->get("session")->get('categoria'));

        return $this->render('persona/index.html.twig', [
                    'personas' => $personas,
        ]);
    }

    /**
     * @Route("/persona_new", name="persona_new")
     * @Method("GET")
     * @CheckPermission()
     */
    public function newAction(Request $request) {
        
        $persona = new Persona();
        
        $persona->addContacto(new PersonaContacto());
        $persona->addDocumento(new PersonaDocumento());
        $persona->addIdioma(new PersonaIdioma());
        $persona->addDomicilio(new PersonaDomicilio());

        $formulario = $this->createForm(
                PersonaType::class, $persona, array('action' => $this->generateUrl('persona_create'),'method' => 'POST','categoria' => $this->get("session")->get('categoria'))
        );

        return $this->render('persona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/persona_create", name="persona_create")
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $persona = new Persona();
        $formulario = $this->createForm(
                PersonaType::class, $persona, array('action' => $this->generateUrl('persona_create'),
            'method' => 'POST','categoria' => $this->get("session")->get('categoria'))
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $categoria = new PersonaCategoria();
            $categoria->setIdCategoria($em->getRepository('AppBundle:Categoria')->find($this->get("session")->get('categoria')));
            $categoria->setPuesto($formulario->get('puesto')->getData());
            $categoria->setDescripcionPuesto($formulario->get('descripcionPuesto')->getData());
            $persona->addCategoria($categoria);

            $em->persist($persona);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha creado la persona : "'. $persona->getApellido() . ' ,' . $persona->getNombre() . '" satisfactoriamente.');
            return $this->redirectToRoute('persona_edit', array('id_persona' => $persona->getIdPersona()));
        }

        return $this->render('persona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/persona_edit/{id_persona}", name="persona_edit")
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, $id_persona) {
        $em = $this->getDoctrine()->getManager();

        $persona = $em->getRepository(Persona::class)->find($id_persona);

        $formulario = $this->createForm(
                PersonaType::class, $persona, array('action' => $this->generateUrl('persona_update', array('id_persona' => $id_persona)),
            'method' => 'PUT','categoria' => $this->get("session")->get('categoria'))
        );
        
        $persona_categoria = $em->getRepository('AppBundle:PersonaCategoria')->findOneBy(['idPersona' => $persona,'idCategoria' => $this->get("session")->get('categoria')]);
        $formulario->get('puesto')->setData($persona_categoria->getPuesto());
        $formulario->get('descripcionPuesto')->setData($persona_categoria->getDescripcionPuesto());

        return $this->render('persona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/persona_update/{id_persona}", name="persona_update")
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, $id_persona) {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository('AppBundle:Persona')->find($id_persona);

        $formulario = $this->createForm(
                PersonaType::class, $persona, array('action' => $this->generateUrl('persona_update', array('id_persona' => $id_persona)),
            'method' => 'PUT','categoria' => $this->get("session")->get('categoria')));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            
            $persona_categoria = $em->getRepository('AppBundle:PersonaCategoria')->findOneBy(['idPersona' => $persona,'idCategoria' => $this->get("session")->get('categoria')]);
            $persona_categoria->setPuesto($formulario->get('puesto')->getData());
            $persona_categoria->setDescripcionPuesto($formulario->get('descripcionPuesto')->getData());
            $em->persist($persona_categoria);
            
            $em->persist($persona);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado la persona : "'. $persona->getApellido() . ' ,' . $persona->getNombre() . '" satisfactoriamente.');
            return $this->redirectToRoute('persona_edit', array('id_persona' => $id_persona));
        }

        return $this->render('persona/new_edit.html.twig', [
                    'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/persona_delete/{id_persona}", name="persona_delete")
     * @CheckPermission()
     */
    public function deleteAction(Request $request, $id_persona) {
//        $em = $this->getDoctrine()->getManager();
//        $persona = $em->getRepository('AppBundle:Persona')->find($id_persona);
//        $em->remove($persona);
//        $em->flush();
        return $this->redirectToRoute('persona_index');
    }

}
