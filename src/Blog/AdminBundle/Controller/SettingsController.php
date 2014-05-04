<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingsController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
            array('actionName' => 'index')
        );
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
                     ->findBy(array('id' => $id));

        var_dump($user); die();
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
