<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 6/22/14
 * Time: 1:21 AM
 */

namespace Blog\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Blog\ModelBundle\Services\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller {

    /**
     * @Template()
     */
    public function usersAction()
    {
        $users = $this->getDoctrine()
                      ->getRepository('ModelBundle:User')
                      ->findAll();

        return array(
            'actionName' => 'users',
            'users'      => $users
        );
    }

    /**
     * @Template("AdminBundle:User:user.html.twig")
     */
    public function createAction()
    {

        //$crateForm = new createForm();

        return array(
            'actionName' => 'create-user',
            'user' => array()
        );
    }

    /**
     * @Template("AdminBundle:User:user.html.twig")
     */
    public function editAction($id)
    {

        $user = $this->getUserManager()
                     ->findOneBy(array('id' => $id));


        return array(
            'actionName' => 'edit-user',
            'user'       => $user
        );
    }

    public function deleteAction($id)
    {

        $user = $this->getUserManager()
                     ->findOneBy(array('id' => $id));

        var_dump($user);
        die();
    }

    /**
     * Get Post manager
     *
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('userManager');
    }
} 