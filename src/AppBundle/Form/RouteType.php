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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManager;

/**
 * Description of RouteType
 *
 * @author Lucas
 */
class RouteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $results = $options['em']->createQueryBuilder('e')->select('e')->from('AppBundle:Route', 'e')->getQuery()->getResult();

        $resultado = array();
        foreach ($results as $result) {
            $resultado[$result->getName()] = $result->getIdRoute();
        }
        
        $builder
                ->add('rutas', ChoiceType::class, array(
                    'placeholder' => 'Seleccione las rutas',
                    'required' => false,
                    'choices' => $resultado,
                    'mapped' => false,
                    'multiple' => true,
                    //'expanded' => true,
                    'label' => 'Rutas'));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'em' => null,
            //'data_class' => '',
            'attr' => array('novalidate' => ''),
                //'validation_groups' => array('registration'),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_route';
    }

}
