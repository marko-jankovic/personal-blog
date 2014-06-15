<?php
/**
 * User: markojankovic
 * Date: 5/24/14
 * Time: 2:57 PM
 */

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RegisterController extends Controller {

    /**
     * Register action
     *
     * @Template()
     */
    public function registerAction()
    {

        //        $user = new User();
        //
        //        $user->setUsername("Marko")
        //             ->setEmail("markj@vast.com")
        //             ->setPassword("123456");
        //
        //        // get entity manager
        //        $em = $this->getDoctrine()->getManager();
        //        $em->persist($user);
        //        $em->flush();

        $actionName = 'register';

        return array('actionName' => $actionName);
    }
}