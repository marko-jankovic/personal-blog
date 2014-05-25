<?php
/**
 * User: markojankovic
 * Date: 5/24/14
 * Time: 2:57 PM
 */

namespace Blog\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\ModelBundle\Form\Type\LoginType;

class SecurityController extends Controller {

    /**
     * Login
     *
     * @param Request $request
     *
     * @return array
     *
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        $form = $this->createForm(new LoginType());
        $form->handleRequest($request);

        //get the error if ther is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'actionName'    => 'login',
            'error'         => $error,
            'form'          => $form->createView()
        );
    }

    public function logoutAction()
    {

    }


    public function loginCheckAction()
    {

    }


    /**
     * Forgot your password
     *
     * @Template()
     */
    public function forgotAction()
    {

        $actionName = 'forgot';

        return array('actionName' => $actionName);
    }

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