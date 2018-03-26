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
use AppBundle\Entity\Categoria;
use AppBundle\Form\PersonaType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Annotation\CheckPermission;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Description of PersonaController
 *
 * @author Lucas
 */
class PersonaController extends Controller {

    /**
     * @Route("/persona/{categoria}", name="persona_index")
     * @ParamConverter("categoria", options={
            "repository_method" = "findByNombreCategoria"
        })
     * @Method("GET")
     * @CheckPermission()
     */
    public function indexAction(Request $request, Categoria $categoria) {

        $em = $this->getDoctrine()->getManager();
        
        /*
        $categoria_ = $em->getRepository('AppBundle:Categoria')->find($categoria);
        $this->get("session")->set('titulo_operacion', $categoria_->getCategoria());
        
        $this->get("session")->set('categoria', $categoria);
        */
        
        $personas = $em->getRepository('AppBundle:Persona')->findByCategoria($categoria->getIdCategoria());

        return $this->render('persona/index.html.twig', [
            'personas' => $personas,
            'categoria' => $categoria->getCategoria(),
        ]);
    }

    /**
     * @Route("/persona/{categoria}/new", name="persona_new")
     * @ParamConverter("categoria", options={
            "repository_method" = "findByNombreCategoria"
        })
     * @Method("GET")
     * @CheckPermission()
     */
    public function newAction(Request $request, Categoria $categoria) {
        
        $persona = new Persona();
        $persona_categoria = new PersonaCategoria();
        $persona_categoria->setIdCategoria($categoria->getIdCategoria());

        $persona->addCategoria($persona_categoria);
        $persona->addContacto(new PersonaContacto());
        $persona->addDocumento(new PersonaDocumento());
        $persona->addIdioma(new PersonaIdioma());
        $persona->addDomicilio(new PersonaDomicilio());

        $formulario = $this->createForm(
            PersonaType::class, $persona, array(
                'action' => $this->generateUrl('persona_create', array(
                    'categoria' => $categoria->getCategoria(),
                )),
                'method' => 'POST',
            )
        );

        return $this->render('persona/new_edit.html.twig', [
            'formulario' => $formulario->createView(),
            'categoria' => $categoria->getCategoria(),
        ]);
    }

    /**
     * @Route("/persona/{categoria}/create", name="persona_create")
     * @ParamConverter("categoria", options={
            "repository_method" = "findByNombreCategoria"
        })
     * @Method("POST")
     * @CheckPermission()
     */
    public function createAction(Request $request, Categoria $categoria) {

        $em = $this->getDoctrine()->getManager();
        $persona = new Persona();

        $formulario = $this->createForm(
            PersonaType::class, $persona, array(
                'action' => $this->generateUrl('persona_create', array(
                        'categoria' => $categoria->getCategoria(),
                    )),
                'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $persona_categoria = new PersonaCategoria();
            $persona_categoria->setIdCategoria($categoria->getIdCategoria());

            $persona_categoria->setPuesto($formulario->get('puesto')->getData());
            $persona_categoria->setDescripcionPuesto($formulario->get('descripcionPuesto')->getData());
            $persona->addCategoria($persona_categoria);

            $em->persist($persona);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha creado la persona : "'. $persona->getApellido() . ' ,' . $persona->getNombre() . '" satisfactoriamente.');
            
            return $this->redirectToRoute('persona_edit', array(
                '_id_persona' => $persona->getIdPersona(),
                'categoria' => $categoria->getCategoria(),
            ));
        }

        return $this->render('persona/new_edit.html.twig', array(
            'formulario' => $formulario->createView(),
            'categoria' => $categoria->getCategoria(),
        ));
    }

    /**
     * @Route("/persona/{categoria}/edit/{_id_persona}", name="persona_edit")
     * @ParamConverter("categoria", options={
            "repository_method" = "findByNombreCategoria"
        })
     * @Method("GET")
     * @CheckPermission()
     */
    public function editAction(Request $request, Categoria $categoria, $_id_persona) {
        $em = $this->getDoctrine()->getManager();

        $persona = $em->getRepository(Persona::class)->find($_id_persona);

        $formulario = $this->createForm(
            PersonaType::class, $persona, array(
                'action' => $this->generateUrl('persona_update', array(
                    '_id_persona' => $_id_persona,
                    'categoria' => $categoria->getCategoria(),
                )),
                'method' => 'PUT',
            )
        );
        
        $persona_categoria = $em->getRepository('AppBundle:PersonaCategoria')->findOneBy(['idPersona' => $persona,'idCategoria' => $categoria->getIdCategoria()]);
        $formulario->get('puesto')->setData($persona_categoria->getPuesto());
        $formulario->get('descripcionPuesto')->setData($persona_categoria->getDescripcionPuesto());

        return $this->render('persona/new_edit.html.twig', [
            'formulario' => $formulario->createView(),
            'categoria' => $categoria->getCategoria(),
        ]);
    }

    /**
     * @Route("/persona/{categoria}/update/{_id_persona}", name="persona_update")
     * @ParamConverter("categoria", options={
            "repository_method" = "findByNombreCategoria"
        })
     * @Method("PUT")
     * @CheckPermission()
     */
    public function updateAction(Request $request, Categoria $categoria, $_id_persona) {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository('AppBundle:Persona')->find($_id_persona);

        $formulario = $this->createForm(
            PersonaType::class, $persona, array(
                'action' => $this->generateUrl('persona_update', array(
                    '_id_persona' => $_id_persona,
                    'categoria' => $categoria->getCategoria(),
                )),
                'method' => 'PUT',
            ));

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            
            $persona_categoria = $em->getRepository('AppBundle:PersonaCategoria')->findOneBy([
                'idPersona' => $persona,
                'idCategoria' =>$categoria->getCategoria(),
            ]);
            $persona_categoria->setPuesto($formulario->get('puesto')->getData());
            $persona_categoria->setDescripcionPuesto($formulario->get('descripcionPuesto')->getData());
            $em->persist($persona_categoria);
            
            $em->persist($persona);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Se ha editado la persona : "'. $persona->getApellido() . ' ,' . $persona->getNombre() . '" satisfactoriamente.');

            return $this->redirectToRoute('persona_edit', array(
                '_id_persona' => $_id_persona,
                'categoria' =>$categoria->getCategoria(),
            ));
        }

        return $this->render('persona/new_edit.html.twig', [
            'formulario' => $formulario->createView(),
            'categoria' =>$categoria->getCategoria(),
        ]);
    }

    /**
     * @Route("/persona/{categoria}/delete/{_id_persona}", name="persona_delete")
     * @ParamConverter("categoria", options={
            "repository_method" = "findByNombreCategoria"
        })
     * @CheckPermission()
     */
    public function deleteAction(Request $request, Categoria $categoria, $_id_persona) {
//        $em = $this->getDoctrine()->getManager();
//        $persona = $em->getRepository('AppBundle:Persona')->find($_id_persona);
//        $em->remove($persona);
//        $em->flush();
        return $this->redirectToRoute('persona_index', array(
            'categoria' =>$categoria->getCategoria(),
        ));
    }

}
