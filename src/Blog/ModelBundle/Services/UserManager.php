<?php
/**
 * User: markojankovic
 * Date: 5/25/14
 * Time: 2:26 PM
 */

namespace Blog\ModelBundle\Services;

use Blog\ModelBundle\Entity\Users;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostManager
 */
class UserManager
{
    public $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Find all users
     *
     * @return array
     */
    public function findAll()
    {
        $users = $this->em->getRepository('ModelBundle:User')->findAll();

        return $users;
    }

    /**
     * Find User by username
     *
     * @param string $array
     *
     * @throws NotFoundHttpException
     * @return User
     */
    public function findOneBy($array)
    {
        $user = $this->em->getRepository('ModelBundle:User')->findOneBy($array);

        if (null === $user) {
            throw new NotFoundHttpException('User was not found');
        }

        return $user;
    }
}