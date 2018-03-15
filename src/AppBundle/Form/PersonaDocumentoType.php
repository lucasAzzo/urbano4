<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\PersonaDocumento;

/**
 * Description of PersonaDocumentoType
 *
 * @author Lucas
 */
class PersonaDocumentoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('idDocumentoTipo', EntityType::class, array(
        'placeholder' => 'Seleccione un documento',
        'class' => 'AppBundle:DocumentoTipo',
        'attr' => array('class' => 'browser-default'),    
        'choice_label' => 'documentoTipo',
        'label' => 'Tipo de documento'))           
        ->add('numero', TextType::class,array('attr' => array('placeholder' => 'Número de documento')))
        //->add('idPersona', HiddenType::class, array())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => PersonaDocumento::class
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_persona_documento';
    }
    
    /**
     * @return null|string
     */
    public function getBlockPrefix() {
        return 'app_documento';
    }
    
    

}
