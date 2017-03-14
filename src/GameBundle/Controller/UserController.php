<?php

namespace GameBundle\Controller;

use GameBundle\Entity\User;
use GameBundle\Form\RegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {
        $user = new User;
        $form = $this->createForm(RegisterType::class, $user);
        $form->remove('confirmPassword')->remove('email');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo = $this->getDoctrine()->getRepository('GameBundle:User');
            dump($form);
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
        }
        //dump($form->createView());
        return $this->render('GameBundle:Default:index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request) {
        $request->getSession()->set('user', NULL);
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/login/register", name="register")
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
        return $this->render('GameBundle:Default:_register.html.twig', ['form' => $form->createView()]);
    }

}
