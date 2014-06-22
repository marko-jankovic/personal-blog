<?php
/**
 * User: markojankovic
 * Date: 6/22/14
 * Time: 5:34 PM
 */

namespace Blog\ModelBundle\Twig\Helpers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class isActive extends \Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'isActive' => new \Twig_Function_Method($this, 'isActive', array('is_safe' => array('html')))
        );
    }

    /**
     * isActive helper
     * Check is current route and add CSS class 'active'
     *
     * @param object $app
     * @param string $routeName
     *
     * @return string|boolen class="active" | false
     *
     */
    public function isActive($app, $routeName)
    {

        $currentPath = $app->getRequest()->get('_route');
        $routeNameLength = strlen($routeName);

        // check is $currentPath subpath of $routeName
        $isSubPath = substr_compare($currentPath, $routeName, 0, $routeNameLength-1);

        if ($currentPath == $routeName || $isSubPath === 0)
        {
            return 'class="active"';
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
        return 'is_active';
    }
} 