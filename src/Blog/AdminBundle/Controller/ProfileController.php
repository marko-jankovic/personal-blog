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
       $userDetails = $this->getDoctrine()
             ->getRepository('ModelBundle:UserDetails')
             ->findOneBy(array('id' => 1));



        return array('actionName' => 'profile');
    }


    public function updateAction()
    {
        return array('actionName' => 'update-profile');
    }
}