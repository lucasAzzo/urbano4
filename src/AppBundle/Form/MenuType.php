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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Menu;

/**
 * Description of MenuType
 *
 * @author Lucas
 */
class MenuType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', TextType::class)
                ->add('orden', TextType::class)
                ->add('path', TextType::class, array('required' => false))
                ->add('parametro', TextType::class, array('required' => false, 'attr' => array('placeholder' => 'Ejemplo: array("param1" => "valor1", "param2" => "valor2")')))
                ->add('idMenuPadre', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    'required' => false,
                    'class' => 'AppBundle:Menu',
                    'choice_label' => 'nombre',
                    'label' => 'Menú Padre'))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Menu::class,
            'attr' => array('class' => 'was-validated', 'novalidate' => ''),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_menu';
    }

}
