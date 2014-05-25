<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{


    public function indexAction(Request $request)
    {
        return $this->render(
            'AdminBundle:Index:index.html.twig',
            array('actionName' => 'index')
        );
    }


    public function usersAction()
    {
        $users = $this->getDoctrine()
                     ->getRepository('ModelBundle:User')
                     ->findAll();

        return $this->render(
            'AdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'users',
                    'users'       => $users
                )
        );
    }

    public function editAction($id) {

        $user = $this->getDoctrine()
                     ->getRepository('ModelBundle:User')
                     ->findOneBy(array('id' => $id));


        return $this->render(
            'AdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'user',
                    'user'      => $user
                )
        );
    }

    public function deleteAction($id)
    {

        $user = $this->getDoctrine()
                     ->getRepository('ModelBundle:User')
                     ->findBy(array('id' => $id));

        var_dump($user);
        die();
    }
}
