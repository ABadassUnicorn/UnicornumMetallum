<?php

namespace UnicornumMetalum\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category', 'entity', array(
                'class' => 'UnicornumMetalumEntityBundle:Category',
                'choice_label' => 'name',
            ))
            ->add('review', 'textarea', array('attr' => array('class' => 'editor1',)))
            ->add('tags', 'collection', array(
                'type' => new TagType(),
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('save', 'submit')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UnicornumMetalum\EntityBundle\Entity\Review',
        ));
    }

    public function getName()
    {
        return 'unicornum_metallum_review';
    }
}