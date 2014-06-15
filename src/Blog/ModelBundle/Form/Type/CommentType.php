<?php

namespace Blog\ModelBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('authorName', null, array('label' => 'name'))
            ->add('body', null, array('label' => 'Message'))
            ->add('send', 'submit', array('label' => 'send'));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\ModelBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'blog_modelbundle_comment';
    }
}
