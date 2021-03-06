<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.

        if(!is_null($this->getUser())){
	        $user = $this->getUser();
	        if(strcasecmp($user->getRole(), 'admin') == 0 || strcasecmp($user->getRole(), 'employee') == 0) {
	            return $this->redirect($this->generateUrl('admin_homepage'));         
	        }
        }

		if ($session->isStarted()) {
			// get the login error if there is one
			if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
				$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
			} else {
				$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
				$session->remove(SecurityContext::AUTHENTICATION_ERROR);
				if ($error != null){
					$error = 'Wrong Username/Password';
				}
			}

			return $this->render('CoreBundle:Core:login.html.twig', array(
				// last username entered by the user
				'last_username' => $session->get(SecurityContext::LAST_USERNAME),
				'error' => $error,
			));
		} else {
			return $this->redirect($this->generateUrl('login'));
		}
		session_destroy();
	}

	public function loginCheckAction()
	{

	}

	public function forbiddenAction()
	{
		throw new AccessDeniedHttpException();
	}
}


