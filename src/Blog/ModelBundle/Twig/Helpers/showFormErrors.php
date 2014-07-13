<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 7/13/14
 * Time: 5:54 PM
 */

namespace Blog\ModelBundle\Twig\Helpers;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class showFormErrors extends \Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'fieldError' => new \Twig_Function_Method($this, 'fieldError', array('is_safe' => array('html')))
        );
    }

    public function fieldError($errors, $type)
    {
        $type = explode(".", $type);

        if(count($type) > 1) {

            if (isset($errors[$type[0]][$type[1]])) {
                return '<p class="error-message">' . $errors[$type[0]][$type[1]] . '</p>';
            }
        }
        else {
            if (isset($errors[$type[0]])) {
                return '<p class="error-message">' . $errors[$type[0]] . '</p>';
            }
        }
        return false;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'show_form_errors';
    }
}