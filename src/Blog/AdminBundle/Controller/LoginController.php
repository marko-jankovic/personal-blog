<?php
/**
 * User: markojankovic
 * Date: 5/24/14
 * Time: 2:57 PM
 */

namespace Blog\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\ModelBundle\Form\Type\LoginType;

class LoginController extends Controller {

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

//    /**
//     * Get Post manager
//     *
//     * @return PostManager
//     */
//    private function getUserManager()
//    {
//        return $this->get('userManager');
//    }
}