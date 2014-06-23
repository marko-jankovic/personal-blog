<?php
/**
 * User: markojankovic
 * Date: 6/22/14
 * Time: 5:34 PM
 */

namespace Blog\ModelBundle\Twig\Helpers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class getUserId extends \Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'getUserId' => new \Twig_Function_Method($this, 'getUserId')
        );
    }

    public function getUserId($app)
    {
        return $app->getSecurity()->getToken()->getUser()->getId();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'get_user_id';
    }
} 