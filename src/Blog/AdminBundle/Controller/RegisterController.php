<?php
/**
 * User: markojankovic
 * Date: 5/24/14
 * Time: 2:57 PM
 */

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Entity\User;
use Blog\ModelBundle\Form\Type\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller {

    /**
     * Register action
     *
     * @Template()
     */
    public function registerAction(Request $request)
    {

        $form = $this->createForm(new RegisterType());

        if($request->isMethod('POST'))
        {

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();

                $user = new User();
                $user->setUsername($data['username']);
                $user->setPassword($this->encodePassword($user, $data['plainPassword']));
                $user->setEmail($data['email']);

                var_dump($user);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();

                return $this->redirect($this->generateUrl('admin_user_login'));
            }
        }

        return array(
            'actionName' => 'register',
            'form' => $form->createView()
        );
    }

    private function encodePassword($user, $plainPassword)
    {
        $encoder = $this->container
                            ->get('security.encoder_factory')
                            ->getEncoder($user);


        return $encoder->encodePassword($plainPassword, $user->getSalt());
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
}