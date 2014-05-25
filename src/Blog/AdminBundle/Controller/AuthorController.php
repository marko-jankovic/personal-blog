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
     */
    public function showAction($slug)
    {

        $author = $this->getDoctrine()->getRepository('ModelBundle:Author')
                     ->findOneBy(
                     array(
                         'slug' => $slug
                     )
            );

        if ($author === null) {
            throw $this->createNotFoundException('Post was not found!');
        }

        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')
                       ->findBy(
                       array(
                           'author' => $author
                       )
            );

        return array(
            'actionName' => 'showPosts',
            'author'     => $author,
            'posts'      => $posts
        );
    }
} 