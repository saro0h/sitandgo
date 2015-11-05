<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
        ));
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('user', $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $salt = $this->get('security.secure_random')->nextBytes(15);
            $user->setSalt($salt);

            $encoder = $this->get('security.password_encoder');
            $pwd = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($pwd);


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'You have been successfully added to our big big family!');

            $this->redirectToRoute('register-success');
        }

        return $this->render('default/register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/register-success", name="register-success")
     */
    public function registerSuccessAction()
    {
        // If the referer is register
            return $this->render('default/register_success.html.twig');
        //else
            return $this->redirectToRoute('homepage');
    }

    public function contactAction()
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/inside", name="home")
     */
    public function homeAction()
    {
        return $this->render('default/home.html.twig');
    }
}
