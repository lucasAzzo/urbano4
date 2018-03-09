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
use AppBundle\Entity\PersonaDomicilio;

/**
 * Description of PersonaDomicilioType
 *
 * @author Lucas
 */
class PersonaDomicilioType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('idDomicilioTipo', EntityType::class, array(
        'placeholder' => 'Seleccione una opción',
        'class' => 'AppBundle:DomicilioTipo',
        // use the User.username property as the visible option string
        'choice_label' => 'domicilioTipo',
        'label' => 'Tipo de Domicilio'))           
        ->add('calle', TextType::class,array('attr' => array('placeholder' => 'Calle')))
        ->add('numero', TextType::class,array('attr' => array('placeholder' => 'Número')))
        ->add('piso', TextType::class, array('required' => false,'attr' => array('placeholder' => 'Piso')))
        ->add('depto', TextType::class, array('required' => false,'attr' => array('placeholder' => 'Departamento')))
        //->add('idPersona', HiddenType::class, array())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => PersonaDomicilio::class
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_persona_domicilio';
    }
    
    /**
     * @return null|string
     */
    public function getBlockPrefix() {
        return 'app_domicilio';
    }
    
     
}
