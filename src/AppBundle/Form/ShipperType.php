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
use AppBundle\Entity\Shipper;

/**
 * Description of ShipperType
 *
 * @author Lucas
 */
class ShipperType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idPais', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    //'required' => false,
                    'class' => 'AppBundle:Pais',
                    'label' => 'Pais'))
                ->add('idRegion', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    //'required' => false,
                    'class' => 'AppBundle:Region',
                    'label' => 'Region'))
                ->add('idProvincia', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    //'required' => false,
                    'class' => 'AppBundle:Provincia',
                    'label' => 'Provincia'))
                ->add('idCiudad', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    //'required' => false,
                    'class' => 'AppBundle:Ciudad',
                    'label' => 'Ciudad'))
                 ->add('idSucursalDefecto', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    //'required' => false,
                    'class' => 'AppBundle:Sucursal',
                    'label' => 'Sucursal defecto'))
                ->add('shiRepresentante', TextType::class)
                ->add('shiRazonSocial', TextType::class)
                ->add('shiDireccion', TextType::class)
                ->add('shiTelefono', TextType::class)
                ->add('shiCuit', TextType::class)
                ->add('shiObservacion', TextType::class,array('required' => false))
                ->add('idEstado', EntityType::class, array(
                    'placeholder' => 'Seleccione una opción',
                    //'required' => false,
                    'class' => 'AppBundle:Estado',
                    'label' => 'Estado'))
                
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Shipper::class,
            'attr' => array('class' => 'was-validated', 'novalidate' => ''),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_shipper';
    }
    
}
