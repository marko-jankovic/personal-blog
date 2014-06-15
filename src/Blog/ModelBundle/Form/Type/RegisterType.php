<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 6/8/14
 * Time: 10:44 PM
 */

namespace Blog\ModelBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class RegisterFormType
 * l
 *
 * @package Yoda\UserBundle\Form
 */
class RegisterType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user_register';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array(
            'required' => false,
            'pattern'  => '[a-zA-Z0-9]+',
            'attr'     => array('class' => 'username-field-custom')
        ))
                ->add('email', 'email')
                ->add('plainPassword', 'repeated', array('type' => 'password'))
                ->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\ModelBundle\Entity\User'
        ));
    }


}