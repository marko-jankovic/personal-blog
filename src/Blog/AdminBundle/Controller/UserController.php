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
     */
    public function updateAction($id)
    {
        var_dump("update", $id);
        die();
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

    /**
     * @Template("AdminBundle:User:account.html.twig")
     */
    public function accountAction($id)
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
     * Get User manager
     *
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('userManager');
    }
} 