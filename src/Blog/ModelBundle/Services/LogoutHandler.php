<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 8/23/14
 * Time: 6:09 PM
 */

namespace Blog\ModelBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;

class LogoutHandler implements LogoutSuccessHandlerInterface {

    private $security;

    public function __construct(SecurityContext $security, EntityManager $em)
    {
        // attached dependencies through service.yml
        $this->security = $security;
        $this->em = $em;
    }

    /**
     * Checking if user should be deleted
     *
     * @param Request $request
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onLogoutSuccess(Request $request) {

        // get current user
        $user = $this->security->getToken()->getUser();

        // check isDeleted field and delete user
        // workaround for deleting current account
        if($user->getUserDeleted()) {

            $this->em->remove($user);
            $this->em->flush();
        }

        // redirect the user to where they were before the login process begun.
        $response = new RedirectResponse($request->headers->get('referer'));

        return $response;
    }
}