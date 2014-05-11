<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 7:23 PM
 */

namespace Blog\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{

    public function indexAction()
    {

        $posts = $this->getDoctrine()
                 ->getRepository('BlogAdminBundle:Post')
                 ->findAll();

        //$latestPost = $this->getDoctrine()->getRepository('BlogAdminBundle:Post')->findLatest(5);
        $findFirst = $this->getDoctrine()->getRepository('BlogAdminBundle:Post')->findFirst();

        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'showPosts',
                    'posts' => $posts
                )
        );
    }


    /**
     * Show a post
     *
     * @param $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/{slug}")
     */
    public function showAction($slug)
    {

        $post = $this->getDoctrine()->getRepository('BlogAdminBundle:Post')
                      ->findOneBy(
                            array(
                                'slug' => $slug
                            )
                        );

        if($post === null)
        {
            throw $this->createNotFoundException('Post was not found!');
        }

        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'showPosts',
                    'posts'      => $post
                )
        );
    }

    public function editAction($id)
    {
        $post = $this->getDoctrine()
                     ->getRepository('BlogAdminBundle:Post')
                     ->findOneBy(array('id' => $id));


        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'editPost',
                    'post'       => $post
                )
        );
    }

    public function newAction()
    {
        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'createPost'
                )
        );
    }

} 