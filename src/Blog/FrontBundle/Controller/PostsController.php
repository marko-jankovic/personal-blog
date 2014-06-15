<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 5/25/14
 * Time: 6:41 PM
 */

namespace Blog\FrontBundle\Controller;

use Blog\ModelBundle\Form\Type\CommentType;
use Blog\ModelBundle\Services\PostManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostsController extends Controller
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
            'posts'      => $posts,
            'actionName' => "showPosts"
        );
    }

    /**
     * Create comment
     *
     * @param Request $request
     * @param string  $slug
     *
     * @return array
     *
     * @Template("FrontBundle:Posts:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $post = $this->getPostManager()->findBySlug($slug);
        $form = $this->getPostManager()->createComment($post, $request);

        if (true === $form) {
            $this->get('session')->getFlashBag()->add('success', 'Your comment was submitted successfully');

            return $this->redirect($this->generateUrl('front_posts_show',
                array(
                    'slug' => $post->getSlug()
                )
            ));
        }

        return array(
            'post'       => $post,
            'form'       => $form->createView(),
            'actionName' => 'showPosts'
        );
    }

    /**
     * Show a post
     *
     * @param $slug
     *
     * @return array
     *
     * @Template()
     */
    public function showAction($slug)
    {
        $post = $this->getPostManager()->findBySlug($slug);

        $form = $this->createForm(new CommentType());

        return array(
            'post'       => $post,
            'actionName' => 'showPosts',
            'form'       => $form->createView()
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