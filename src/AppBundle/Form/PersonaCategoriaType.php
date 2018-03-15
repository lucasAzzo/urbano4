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
use AppBundle\Entity\PersonaCategoria;

/**
 * Description of PersonaCategoriaType
 *
 * @author Lucas
 */
class PersonaCategoriaType extends AbstractType{
    
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('idCategoria', EntityType::class, array(
        'placeholder' => 'Seleccione una categoría',    
        'class' => 'AppBundle:Categoria',
        'attr' => array('class' => 'browser-default'),    
        'choice_label' => 'categoria',
        'label' => 'Categoria'))           
        ->add('puesto', TextType::class,array('attr' => array('placeholder' => 'Puesto')))
        ->add('descripcionPuesto', TextType::class,array('attr' => array('placeholder' => 'Descripción del Puesto')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => PersonaCategoria::class
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_persona_categoria';
    }
    
    /**
     * @return null|string
     */
    public function getBlockPrefix() {
        return 'app_categoria';
    }
    
    
    
}
