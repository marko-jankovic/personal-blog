<?php
/**
 * User: markojankovic
 * Date: 5/24/14
 * Time: 2:57 PM
 */

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ForgotController extends Controller {

    /**
     * Register action
     *
     * @Template()
     */
    public function forgotAction()
    {
        $actionName = 'forgot';

        return array('actionName' => $actionName);
    }
}