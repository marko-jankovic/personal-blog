<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 11:37 PM
 */

namespace Blog\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorController extends Controller{


    /**
     * Show a posts by Author
     *
     * @param $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/author/{slug}")
     */
    public function showAction($slug)
    {

        $author = $this->getDoctrine()->getRepository('BlogAdminBundle:Author')
                     ->findOneBy(
                     array(
                         'slug' => $slug
                     )
            );

        if ($author === null) {
            throw $this->createNotFoundException('Post was not found!');
        }

        $posts = $this->getDoctrine()->getRepository('BlogAdminBundle:Post')
                       ->findBy(
                       array(
                           'author' => $author
                       )
            );

        return $this->render(
            'BlogAdminBundle:Index:index.html.twig',
                array(
                    'actionName' => 'showPosts',
                    'author'     => $author,
                    'posts'      => $posts
                )
        );
    }
} 