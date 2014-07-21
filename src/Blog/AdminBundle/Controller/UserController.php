<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 6/22/14
 * Time: 1:21 AM
 */

namespace Blog\AdminBundle\Controller;


use Blog\ModelBundle\Entity\User;
use Blog\ModelBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Blog\ModelBundle\Services\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller {

    /**
     * @Template()
     */
    public function usersAction()
    {
        $users = $this->getDoctrine()
                      ->getRepository('ModelBundle:User')
                      ->findAll();

        return array(
            'actionName' => 'users',
            'users'      => $users
        );
    }

    /**
     * @Template("AdminBundle:User:user.html.twig")
     */
    public function createAction()
    {

        //$crateForm = new createForm();

        return array(
            'actionName' => 'create-user',
            'user' => array()
        );
    }

    private function isCurrentUser($currentId)
    {

        $isGranted = $this->get('security.context')->isGranted('ROLE_ADMIN');
        $userId = (string)$this->getUser()->getId();

        if(!$isGranted && $currentId !== $userId) {
            return false;
        }
        return true;
    }

    /**
     * @Template()
     */
    public function accountAction($id) {

        $user = $this->getUserManager()
                     ->findOneBy(array('id' => $id));

        return array(
            'actionName' => 'user-account',
            'user'       => $user
        );
    }

    /**
     * @Template()
     */
    public function editAction(Request $request, $id)
    {

        if (!$this->isCurrentUser($id)) {
            throw new AccessDeniedException();
        }

        $errors = array();

        $user = $this->getUserManager()
                     ->findOneBy(array('id' => $id));

        $form = $this->createForm(new UserType(), $user);

        if ($request->isMethod('POST')) {

            $form->bind($request);
            $manager = $this->getDoctrine()->getManager();

            if ($form->isValid()) {

                $data = $form->getData();

                $user->setUsername($data->getUsername());
                $user->setPassword($this->encodePassword($user, $data->getPlainPassword()));
                $user->setEmail($data->getEmail());


                $manager->persist($user);
                $manager->flush();

                $request->getSession()
                        ->getFlashBag()
                        ->add('success', 'Your credentials has been updated');

                if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
                    return $this->redirect($this->generateUrl('admin_user'));
                }
                else {
                    return $this->redirect($this->generateUrl('admin_user_login'));
                }

            } else {

                // Reset to default values or else it will get saved to the session
                $manager->refresh($user);

                $errors = $this->get('form_errors')->getArray($form);
            }
        }

        return array(
            'actionName' => 'edit-user',
            'errors' => $errors,
            'user'       => $user,
            'form' => $form->createView()
        );
    }

    /**
     * Delete User
     *
     * @return RedirectResponse
     *
     * @param $id
     */
    public function deleteAction($id)
    {

        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUserManager()->findOneBy(array('id' => $id));

        $manager->remove($user);
        $manager->flush();

        return $this->redirect($this->generateUrl('admin_user'));
    }


    public function statusAction($id, $flag) {

        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUserManager()->findOneBy(array('id' => $id));

        $flag = filter_var($flag, FILTER_VALIDATE_BOOLEAN);

        $user->setIsActive($flag);
        $manager->persist($user);
        $manager->flush();

        return $this->redirect($this->generateUrl('admin_user'));
    }

    /**
     * Get User manager
     *
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('userManager');
    }

    private function encodePassword($user, $plainPassword)
    {
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);


        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
} 