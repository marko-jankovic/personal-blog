<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 7:23 PM
 */

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Form\Type\CommentType;
use Blog\ModelBundle\Services\PostManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{

    /**
     * @return array
     *
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getPostManager()->findAll();

        return array(
            'posts'         => $posts,
            'actionName'    => "showPosts"
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
     * @Template()
     */
    public function showAction($slug)
    {
        $post = $this->getPostManager()->findBySlug($slug);

        $form = $this->createForm(new CommentType());

        return array(
            'post'      => $post,
            'actionName' => 'showPosts',
            'form'       => $form->createView()
        );
    }

    /**
     * @Template()
     */
    public function editAction($id)
    {
        $post = $this->getDoctrine()
                     ->getRepository('ModelBundle:Post')
                     ->findOneBy(array('id' => $id));


        return array(
            'actionName' => 'editPost',
            'post'       => $post
        );
    }

    public function deleteAction($id)
    {

        $user = $this->getPostManager()
                     ->findOneBy(array('id' => $id));

        var_dump($user);
        die();
    }

    /**
     * @Template()
     */
    public function newAction()
    {
        return array(
            'actionName' => 'createPost'
        );
    }

    /**
     * Get Post manager
     *
     * @return PostManager
     */
    private function getPostManager()
    {
        return $this->get('postManager');
    }

} 