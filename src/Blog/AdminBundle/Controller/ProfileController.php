<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 6/22/14
 * Time: 5:50 PM
 */

namespace Blog\AdminBundle\Controller;


use Blog\ModelBundle\Form\Type\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller {

    /**
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $user = $this->getUser();

        if ($request->request->has('deleteUser')) {

            return $this->redirect($this->generateUrl('admin_user_delete', array(
                'id' => $user->getId()
            )));
        }

        $errors = array();
        $userDetails = $user->getDetails();
        $form = $this->createForm(new ProfileType(), $userDetails);

        if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();

                $userDetails->setFullName($data->getFullName());
                $userDetails->setLocation($data->getLocation());
                $userDetails->setLinkedin($data->getLinkedin());
                $userDetails->setGithub($data->getGithub());
                $userDetails->setCompany($data->getCompany());
                $userDetails->setTwitter($data->getTwitter());
                $userDetails->setAvatar('test');

                $userDetails->setUser($user);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($userDetails);
                $manager->flush();

                return $this->redirect($this->generateUrl('admin_profile'));

            } else {
                $errors = $this->get('form_errors')->getArray($form);
            }
        }

        return array(
            'form' => $form->createView(),
            'errors' => $errors,
            'userDetails' => $userDetails,
            'actionName' => 'profile'
        );
    }


    public function updateAction()
    {
        return array('actionName' => 'update-profile');
    }
}