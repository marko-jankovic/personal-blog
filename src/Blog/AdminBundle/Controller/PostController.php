<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 7:23 PM
 */

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Form\Type\CommentType;
use Blog\ModelBundle\Form\Type\PostType;
use Blog\ModelBundle\Services\PostManager;
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
        $user = $this->getUser();

        // show all posts
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $posts = $this->getPostManager()->findAll();
        }
        // show only current user posts
        else {
            $posts = $user->getPosts();
        }

        return array(
            'posts'         => $posts,
            'actionName'    => "show-posts"
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
            'actionName' => 'show-posts',
            'form'       => $form->createView()
        );
    }

    /**
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $errors = array();
        $post = $this->getPostManager()->findOneBy(array('id' => $id));

        $form = $this->createForm(new PostType(), $post);

        if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();

                $post->setTitle($data->getTitle());
                $post->setBody($data->getBody());
                $post->setUser($this->getUser());
                $post->setCategory($data->getCategory());

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($post);
                $manager->flush();

                return $this->redirect($this->generateUrl('admin_post'));

            } else {
                $errors = $this->get('form_errors')->getArray($form);
            }
        }

        return array(
            'actionName' => 'edit-post',
            'errors' => $errors,
            'form'   => $form->createView()
        );
    }

    public function deleteSelectedAction(Request $request) {

        $redirect = $this->redirect($this->generateUrl('admin_post'));

        if ($request->isMethod('POST')) {

            if($request->get('bulk-action') && $request->get('delete-posts')) {

                $selectedPosts = $request->get('posts');

                $manager = $this->getDoctrine()->getManager();
                $posts   = $this->getPostManager()
                                ->findByList($selectedPosts);

                foreach ($posts as $post) {
                    $manager->remove($post);
                    $manager->flush();
                }

                return $redirect;
            }
            else {
                return $redirect;
            }
        }
        else {
            return $redirect;
        }
    }

    public function deleteAction($id)
    {

        $manager = $this->getDoctrine()->getManager();
        $post = $this->getPostManager()
                     ->findOneBy(array('id' => $id));


        $manager->remove($post);
        $manager->flush();

        return $this->redirect($this->generateUrl('admin_post'));
    }

    /**
     * @Template()
     */
    public function createAction(Request $request)
    {

        $errors = array();

        $form = $this->createForm(new PostType());

        if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();
                $post = new Post();

                $post->setTitle($data->getTitle());
                $post->setBody($data->getBody());
                $post->setUser($this->getUser());

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($post);
                $manager->flush();

                return $this->redirect($this->generateUrl('admin_post'));

            } else {
                $errors = $this->get('form_errors')->getArray($form);
            }
        }


        return array(
            'actionName' => 'create-post',
            'errors' => $errors,
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