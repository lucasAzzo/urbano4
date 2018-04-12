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
use AppBundle\Service\FileUploader;
use AppBundle\Entity\ShipperOriginal;
use AppBundle\Entity\Shipper;
use AppBundle\Entity\OriginalFile;


class UploadController extends Controller
{

    /**
     * @Route("/upload", name="upload")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function newAction(Request $request) {
        $formulario = $this->createForm(
            UploadFormType::class, null, array('action' => $this->generateUrl('upload_create'), 'method' => 'POST')
        );
        return $this->render('upload/new_upload.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }

    /**
     * @Route("/upload/create", name="upload_create")
     * @Method("POST")
     * @Security("is_authenticated()")
     */
    public function createAction(Request $request, FileUploader $fileUploader) {

        $em = $this->getDoctrine()->getManager();
        $formulario = $this->createForm(
            UploadFormType::class, null, array('action' => $this->generateUrl('upload_create'),
                'method' => 'POST')
        );

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {

            $shipper = $em->getRepository(Shipper::class)->find($formulario->get('shipper')->getData());
            
            $file = $fileUploader->upload($formulario->get('upload_file')->getData(), $shipper->getIdShipper());
            
            $data = $fileUploader->lecturaArchivo($file);
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            
            
            /* me fijo si el archivo existe (en tal caso retorno error), caso contrario, guardo la info del archivo en bd */
                $archivo = $em->getRepository('AppBundle:OriginalFile')->findOneBy(['nombreArchivo' => $formulario->get('upload_file')->getData()->getClientOriginalName(), 'idShipper' => $shipper]);
                if (empty($archivo)) {
                    $original_file = new OriginalFile();
                    $original_file->setFecha(new \DateTime());
                    $original_file->setIdShipper($shipper);
                    $original_file->setIdUsuario($usuario);
                    $original_file->setNombreArchivo($formulario->get('upload_file')->getData()->getClientOriginalName());
                    $em->persist($original_file);
                } else{
                    $request->getSession()->getFlashBag()->add('error','El archivo: "'. $formulario->get('upload_file')->getData()->getClientOriginalName() . '" ya existe para el shipper:"' . $shipper->getShiRepresentante());
                    return $this->render('upload/new_upload.html.twig', [
                        'formulario' => $formulario->createView(),
                    ]);
                }
            /* -------- */
                
            /* persisto la data del archivo */
            foreach ($data as $key => $fila) {
                if ($formulario->get('cabezera')->getData() && $key == 0) {
                    continue;
                } else{
                    $shipper_original = new ShipperOriginal();
                    $shipper_original->setIdUsuario($usuario);
                    $shipper_original->setDescripcion($fila);
                    $shipper_original->setIdShipper($shipper);
                    $shipper_original->setFecha(new \DateTime());
                    $shipper_original->setIdOriginalFile($original_file);
                    $em->persist($shipper_original);
                }
            }
            /* ----------- */
            
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('success','El archivo: "'. $formulario->get('upload_file')->getData()->getClientOriginalName() . '" se ha guardado satisfactoriamente.');
            return $this->render('upload/structure_confirmation.html.twig', [
                'cabezera' => explode(';',current($data)),
                'id_original_file' => $original_file->getId(),    
            ]);
        }

        return $this->render('upload/new_upload.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }
    
    /**
     * @Route("/upload/structure/confirmation/{_id_original_file}/{_cabezera}", name="upload_structure_confirmation")
     * @Method("GET")
     * @Security("is_authenticated()")
     */
    public function confirmationAction(Request $request, $_id_original_file, $_cabezera) {
        
        $em = $this->getDoctrine()->getManager();
        
        /* @var $origina_file \AppBundle\Entity\OriginalFile */
        $original_file = $em->getRepository(OriginalFile::class)->find($_id_original_file);
        $data_archive = $em->getRepository(ShipperOriginal::class)->findBy(['idOriginalFile' => $original_file]);
        
        return $this->render('upload/structure_confirmation.html.twig', [
            
        ]);
        
    }


}
