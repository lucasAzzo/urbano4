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
use AppBundle\Entity\PersonaContacto;

/**
 * Description of PersonaContactoType
 *
 * @author Lucas
 */
class PersonaContactoType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('idContactoTipo', EntityType::class, array(
        'placeholder' => 'Seleccione una opción',
        'class' => 'AppBundle:ContactoTipo',
        // use the User.username property as the visible option string
        'choice_label' => 'contactoTipo',
        'label' => 'Contacto Tipo'))           
        ->add('numeroContacto', TextType::class,array('attr' => array('placeholder' => 'Número de contacto')))
        //->add('idPersona', HiddenType::class, array())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => PersonaContacto::class
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_persona_contacto';
    }
    
    /**
     * @return null|string
     */
    public function getBlockPrefix() {
        return 'app_contacto';
    }
    
    
}
