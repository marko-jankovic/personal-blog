<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($request->getSession()->has('login'))
        {
            return $this->render(
                        'BlogAdminBundle:Index:index.html.twig',
                            array('actionName' => 'index')
            );
        }
        else {
            return $this->redirect($this->generateUrl('admin_login'));
        }
    }


    public function usersAction()
    {
        $users = $this->getDoctrine()
                     ->getRepository('BlogAdminBundle:User')
                     ->findAll();

        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'users',
                    'users'       => $users
                )
        );
    }

    public function editAction($id) {

        $user = $this->getDoctrine()
                     ->getRepository('BlogAdminBundle:User')
                     ->findOneBy(array('id' => $id));


        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'user',
                    'user'      => $user
                )
        );
    }

    public function deleteAction($id)
    {

        $user = $this->getDoctrine()
                     ->getRepository('BlogAdminBundle:User')
                     ->findBy(array('id' => $id));

        var_dump($user);
        die();
    }
}
