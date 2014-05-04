<?php

namespace Blog\AdminBundle\Controller;

use Blog\AdminBundle\Entity\User;
use Blog\AdminBundle\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render(
                    'BlogAdminBundle:Index:index.html.twig',
                        array('actionName' => 'index')
        );
    }

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

        return $this->render(
            'BlogAdminBundle:Index:register.html.twig',
            array('actionName' => $actionName)
        );
    }

    public function forgotAction(){

        $actionName = 'forgot';

        return $this->render(
                    'BlogAdminBundle:Index:forgot.html.twig',
                        array('actionName' => $actionName)
        );
    }

    public function loginAction(Request $request)
    {

        $user = $this->getDoctrine()
                     ->getRepository('BlogAdminBundle:User')
                     ->find(1);


        $form = $this->createForm(new LoginType(), $user);

        $form->handleRequest($request);

        if($form->isValid()) {
            return $this->redirect($this->generateUrl('admin_setting'));
        }

        return $this->render(
            'BlogAdminBundle:Index:login.html.twig',
            array(
                'actionName' => 'login',
                'form' => $form->createView(),
                'user' => $user
            )
        );
    }
}
