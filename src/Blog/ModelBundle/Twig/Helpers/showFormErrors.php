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
            'showFormError' => new \Twig_Function_Method($this, 'showFormError', array('is_safe' => array('html')))
        );
    }

    public function showFormError($errors)
    {

        if (empty($errors)) {
            return false;
        }

        $errorMessage = '<ul class="error-message">';

        // special case for Assert\True
        if(!is_array($errors)) {
            $errorMessage .= '<li>' . $errors . '</li></ul>';

            return $errorMessage;
        }

        foreach($errors as $error) {

            if(is_array($error)) {

                foreach($error as $subError){
                    $errorMessage .= '<li>'. $subError .'</li>';
                }
            }
            else {
                $errorMessage .= '<li>' . $error . '</li>';
            }
        }
        $errorMessage .= '</ul>';

        return $errorMessage;
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