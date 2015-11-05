<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $helper = $this->get('security.authentication_utils');

        return $this->render('security/login.html.twig', array(
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError()
        ));
    }

    /**
     * @Route("/admin/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * @Route("/admin/logout", name="logout")
     */
    public function logoutAction()
    {
    }
}
