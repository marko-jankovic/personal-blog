<?php

namespace Blog\ModelBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RegisterType
 */
class UserType extends AbstractType
{

    private $isGranted;

    public function __construct($isGranted)
    {
        $this->isGranted = $isGranted;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if ($this->isGranted) {

            $builder->add('userRoles', 'entity', array(
                'property'    => 'name',
                'class'       => 'ModelBundle:Role',
                'required'   => false,
                'empty_value' => 'Add Role'
            ));
        }

        $builder
            ->add('email', 'email')
            ->add('plainPassword', 'password', array(
                'required' => false,
                'attr'     => array("autocomplete" => "off")
            ))
            ->add('confirmPassword', 'password', array(
                'required' => false,
                'attr'     => array("autocomplete" => "off")
            ));

    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user_update';
    }

    /**
     * Prepopulate forme with current user data
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\ModelBundle\Entity\User'
        ));
    }
}
