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
 * Class CategoryType
 */
class CategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('name', 'text')
            ->add('description', 'textarea');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'create_category';
    }
    	
}