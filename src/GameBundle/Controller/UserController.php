<?php

namespace GameBundle\Controller;

use GameBundle\Entity\User;
use GameBundle\Form\LoginType;
use GameBundle\Form\RegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/user/login", name="user_login")
     */
    public function loginAction(Request $request) {
        $user = new User;
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $repo = $this->getDoctrine()->getRepository('GameBundle:User');

            $userValid = $repo->findOneBy(array(
                'pseudo' => $user->getPseudo(),
                'password' => $user->getPassword(),
            ));

            if ($userValid) {
                $request->getSession()->set("user", $userValid);
                $request->getSession()->getFlashBag()->add('success', "Connecté");
            } else {
                $request->getSession()->getFlashBag()->add('error', 'Identifiants incorrects');
            }
            return $this->redirectToRoute('homepage');
        }
        //dump($form->createView());
        return $this->render('GameBundle:User:login.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/user/logout", name="user_logout")
     */
    public function logoutAction(Request $request) {
        $request->getSession()->set('user', NULL);
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/user/register", name="user_register")
     */
    public function registerAction(Request $request) {
        $user = new User;
        $form = $this->createForm(RegisterType::class, $user);
        $form->remove('password');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$password = $this->get('security.password_encoder')->encodePassword($user, $user->getConfirmPassword());
            $user->setPassword($user->getConfirmPassword());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        return $this->render('GameBundle:User:register.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/user/profil/", name="user_profil")
     */
    public function profilAction(Request $request) {
        $user = $request->getSession()->get('user');

        return $this->render('GameBundle:User:profil.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/user/lost_password/", name="user_lost_password")
     */
    public function lostPasswordAction() {
        return $this->render('GameBundle:User:lost_password.html.twig');
    }

}
