<?php
/**
 * User: markojankovic
 * Date: 5/4/14
 * Time: 11:26 PM
 */

namespace Blog\ModelBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_email', 'email', array(
                'label' => 'Email: *'
            ))
            ->add('_password', 'password', array(
                 'label' => 'Password: *'
            ))
            ->add('_remember_me', 'checkbox', array(
                'label'    => 'Keep me signed in',
                'required' => false
            ));

    }

    public function getName()
    {
        return '';
    }
}