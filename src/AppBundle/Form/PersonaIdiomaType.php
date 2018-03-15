<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\PersonaIdioma;

/**
 * Description of PersonaIdiomaType
 *
 * @author Lucas
 */
class PersonaIdiomaType extends AbstractType {
    
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('idIdioma', EntityType::class, array(
        'placeholder' => 'Seleccione un idioma',
        'class' => 'AppBundle:Idioma',
        'attr' => array('class' => 'browser-default'),    
        'choice_label' => 'idioma',
        'label' => 'Idioma'))           
        ->add('nivel', TextType::class,array('attr' => array('placeholder' => 'Nivel')))
        //->add('idPersona', HiddenType::class, array())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => PersonaIdioma::class
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_persona_idioma';
    }
    
    /**
     * @return null|string
     */
    public function getBlockPrefix() {
        return 'app_idioma';
    }
    
    
}
