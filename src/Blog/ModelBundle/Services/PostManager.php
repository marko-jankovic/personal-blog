<?php
/**
 * User: markojankovic
 * Date: 5/25/14
 * Time: 2:26 PM
 */

namespace Blog\ModelBundle\Services;

use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Form\Type\CommentType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostManager
 */
class PostManager
{
    public $em;
    private $formFactory;

    /**
     * @param EntityManager        $em
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManager $em, FormFactoryInterface $formFactory)
    {
        $this->em          = $em;
        $this->formFactory = $formFactory;
    }

    /**
     * Find all posts
     *
     * @return array
     */
    public function findAll()
    {
        $posts = $this->em->getRepository('ModelBundle:Post')->findAll();

        return $posts;
    }

    /**
     * Find all posts for a given author
     *
     * @param User $user
     *
     * @return array
     */
    public function findPosts($user)
    {
        $posts = $this->em->getRepository('ModelBundle:Post')->findBy(
              array(
                  'user' => $user
              )
        );

        return $posts;
    }

    /**
     * Find latest posts
     *
     * @param int $num
     *
     * @return array
     */
    public function findLatest($num)
    {
        $latestPosts = $this->em->getRepository('ModelBundle:Post')->findLatest($num);

        return $latestPosts;
    }

    /**
     * Find Post by slug
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return Post
     */
    public function findBySlug($slug)
    {
        $post = $this->em->getRepository('ModelBundle:Post')->findOneBy(
            array(
             'slug' => $slug
            )
        );

        if (null === $post) {
            throw new NotFoundHttpException('Post was not found');
        }

        return $post;
    }

    /**
     * Find Post
     *
     * @param string $array
     *
     * @throws NotFoundHttpException
     * @return Post
     */
    public function findOneBy($array)
    {
        $post = $this->em->getRepository('ModelBundle:Post')->findOneBy($array);

        if (null === $post) {
            throw new NotFoundHttpException('Post was not found');
        }

        return $post;
    }

    /**
     * Create and validate a new comment
     *
     * @param Post    $post
     * @param Request $request
     *
     * @return FormInterface|boolean
     */
    public function createComment(Post $post, Request $request)
    {
        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->formFactory->create(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->em->persist($comment);
            $this->em->flush();

            return true;
        }

        return $form;
    }
}