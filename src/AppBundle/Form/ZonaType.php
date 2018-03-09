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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Zona;
use AppBundle\Form\SubzonaType;

/**
 * Description of ZonaType
 *
 * @author Lucas
 */
class ZonaType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('zona', TextType::class)
                ->add('subzonas', CollectionType::class, array(
                    'entry_type' => SubzonaType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ))
                
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Zona::class,
            'attr' => array('class' => 'was-validated', 'novalidate' => ''),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_zona';
    }
    
}
