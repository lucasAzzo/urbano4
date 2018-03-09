<?php
/**
 * Created by PhpStorm.
 * User: aleda
 * Date: 6/3/2018
 * Time: 12:36
 */

namespace AppBundle\Form;


use AppBundle\Entity\Upload;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadFormType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('upload_file', FileType::class)
            ->add('upload_shippers', EntityType::class, array(
                'placeholder' => 'Seleccione una opción',
                'class' => 'AppBundle:Shipper',
                'choice_label' => 'shiRazonSocial',
                'label' => 'Shipper',
                 'multiple'=>true,))
            /*->add('upload_user', HiddenType::class, array(
                'data'=>
            ))*/
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Upload::class,
            'csrf_token_id' => 'Upload',
        ));
    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Upload_form';
    }

}