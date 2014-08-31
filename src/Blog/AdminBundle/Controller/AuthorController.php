<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 11:37 PM
 */

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AuthorController extends Controller{


    /**
     * Show a posts by Author
     *
     * @param $slug
     *
     * @throws NotFoundHttpException
     * @return array
     * @Template()
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
            throw $this->createNotFoundException('Author was not found!');
        }

        return array(
            'actionName' => 'showPosts',
            'author'     => $author
        );
    }
}