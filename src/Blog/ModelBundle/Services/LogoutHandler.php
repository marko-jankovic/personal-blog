<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 8/23/14
 * Time: 6:09 PM
 */

namespace Blog\ModelBundle\Services;


use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;

class LogoutHandler implements LogoutSuccessHandlerInterface {

    private $security;

    public function __construct(SecurityContext $security)
    {
        $this->security = $security;
    }

    public function onLogoutSuccess(Request $request) {

        // redirect the user to where they were before the login process begun.
        $referer_url = $request->headers->get('referer');

        $response = new RedirectResponse($referer_url);

        return $response;
    }
}