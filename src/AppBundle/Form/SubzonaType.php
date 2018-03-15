<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Subzona;

/**
 * Description of SubzonaType
 *
 * @author Lucas
 */
class SubzonaType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('subzona', TextType::class, array('attr' => array('placeholder' => 'Nombre de la subzona')))
                
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Subzona::class,
            'attr' => array('class' => 'was-validated', 'novalidate' => ''),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_subzona';
    }
    
    /**
     * @return null|string
     */
    public function getBlockPrefix() {
        return 'app_subzona';
    }
    
}
