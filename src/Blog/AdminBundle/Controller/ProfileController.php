<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 6/22/14
 * Time: 5:50 PM
 */

namespace Blog\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller {

    /**
     * @Template()
     */
    public function indexAction()
    {
        return array('actionName' => 'profile');
    }
}