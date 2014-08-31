<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 6/22/14
 * Time: 5:12 PM
 */

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentsController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        // show all comments
        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $comments = $this->getCommentManager()->findAll();
        }
        // show only current user comments
        else {
            $comments = $user->getComments();
        }

        return array(
            'comments'      => $comments,
            'actionName' => "show-comments"
        );
    }


    public function commentsDeleteAction(Request $request)
    {

        $redirect = $this->redirect($this->generateUrl('admin_comments'));

        if ($request->isMethod('POST')) {

            if ($request->get('bulk-action') && $request->get('delete-comments')) {

                $selectedComments = $request->get('comments');

                $manager = $this->getDoctrine()->getManager();
                $comments   = $this->getCommentManager()
                                ->findByList($selectedComments);

                foreach ($comments as $comment) {
                    $manager->remove($comment);
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

    /**
     * Get Comment manager
     *
     * @return CommentManager
     */
    private function getCommentManager()
    {
        return $this->get('commentManager');
    }
} 