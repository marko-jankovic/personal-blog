<?php
/**
 * User: markojankovic
 * Date: 5/25/14
 * Time: 2:22 PM
 */

namespace Blog\ModelBundle\Services;

use Blog\ModelBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class AuthorManager
 */
class AuthorManager
{
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Find Author by slug
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return Author
     */
    public function findBySlug($slug)
    {
        $author = $this->em->getRepository('ModelBundle:User')->findOneBy(
           array(
               'slug' => $slug
           )
        );

        if (null === $author) {
            throw new NotFoundHttpException('Author was not found');
        }

        return $author;
    }

    /**
     * Find all posts for a given author
     *
     * @param User $user
     *
     * @return array
     */
    public function findPosts(User $user)
    {
        $posts = $this->em->getRepository('ModelBundle:Post')->findBy(
          array(
              'user' => $user
          )
        );

        return $posts;
    }
}