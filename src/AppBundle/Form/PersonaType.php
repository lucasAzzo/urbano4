<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Persona;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\PersonaDocumentoType;
use AppBundle\Form\PersonaIdiomaType;
use AppBundle\Form\PersonaContactoType;
use AppBundle\Form\PersonaDomicilioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Description of PersonaType
 *
 * @author Lucas
 */
class PersonaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fisicaJuridica', ChoiceType::class, array(
                    //'label' => 'Tipo de persona',
                    'choices' => array(
                        'Tipo de persona' => '',
                        'Fisica' => 'F',
                        'Juridica' => 'J'
                    ))
                )
                ->add('puesto', TextType::class, array('mapped' => false))
                ->add('descripcionPuesto', TextType::class, array('mapped' => false, 'required' => false))

                //->addEventSubscriber(new AddPersonaTipoFieldSubscriber())        
                ->add('documentos', CollectionType::class, array(
                    'entry_type' => PersonaDocumentoType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ))
                ->add('idiomas', CollectionType::class, array(
                    'entry_type' => PersonaIdiomaType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ))
                ->add('contactos', CollectionType::class, array(
                    'entry_type' => PersonaContactoType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ))
                ->add('domicilios', CollectionType::class, array(
                    'entry_type' => PersonaDomicilioType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ))
//                ->add('categorias', CollectionType::class, array(
//                    'entry_type' => PersonaCategoriaType::class,
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'by_reference' => false,
//                    'label' => false
//                ))
        ;


        $builder->add('nombre', TextType::class, array('required' => 'required'))
                ->add('apellido', TextType::class, array('required' => 'required'))
                ->add('fechaNacimiento', DateType::class, array(
                    'widget' => 'single_text',
                    'attr' => array('class' => 'datepicker'),
                    'label' => 'Fecha de nacimiento',
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'categoria' => null,
            'data_class' => Persona::class,
            'attr' => array('novalidate' => ''),
                //'validation_groups' => array('registration'),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_persona';
    }

}
