<?php

/**
 * Created by PhpStorm.
 * User: aleda
 * Date: 6/3/2018
 * Time: 12:36
 */

namespace AppBundle\Form;

use AppBundle\Entity\Upload;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadFormType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        //dump($options["em"]);die;
        
//        $results = $options["em"]->getRepository("AppBundle:Shipper")->findAll();
//        $data = array();
//        foreach ($results as $fila) {
//            $data[] = array("id" => $fila->getId(), "name" => $fila->getShiRepresentante());
//        }
        
        $builder
                ->add('upload_file', FileType::class)
                ->add('shipper', ChoiceType::class, array(
                    'placeholder' => 'Seleccione una opción',
                'choices'  => array(
                    'Shipper 1' => 1,
                ),
                    'label' => 'Shipper',))
                ->add('cabezera', ChoiceType::class, array(
                'choices'  => array(
                        'Si' => true,
                        'No' => false,
                    ),
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'em' => null,
            'csrf_token_id' => 'Upload',
        ));
    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'Upload_form';
    }

}
