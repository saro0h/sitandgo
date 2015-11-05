<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/admin/users", name="list_users")
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/user/list.html.twig', array('users' => $users));
    }

    /**
     * @Route("/admin/{user}/enable", name="enable_user")
     */
    public function enableUserAction(User $user)
    {
        $user->enable();
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', sprintf('"%s" has been enabled.'));

        return $this->redirectToRoute('list_users');
    }

    /**
     * @Route("/admin/{user}/desable", name="enable_user")
     */
    public function disableUserAction(User $user)
    {
        $user->disable();
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', sprintf('"%s" has been disabled.'));

        return $this->redirectToRoute('list_users');
    }
}
