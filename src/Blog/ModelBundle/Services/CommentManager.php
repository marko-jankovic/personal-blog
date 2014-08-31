<?php
/**
 * User: markojankovic
 * Date: 5/25/14
 * Time: 2:26 PM
 */

namespace Blog\ModelBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostManager
 */
class CommentManager
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
        $comment = $this->em->getRepository('ModelBundle:Comment')->findAll();

        return $comment;
    }

    /**
     * @param $selectedComments
     *
     * @throws NotFoundHttpException
     *
     * @return array $comments
     */
    public function findByList($selectedComments)
    {

        $comments = [];

        foreach ($selectedComments as $key => $value) {

            $comment = $this->em->getRepository('ModelBundle:Comment')->findOneBy(array(
                'id' => $value
            ));

            if (null === $comment) {
                throw new NotFoundHttpException('Comment was not found');
            }

            array_push($comments, $comment);
        }

        return $comments;
    }
}