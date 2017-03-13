<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GameBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Form\RegisterType;

class UserController extends Controller {

    /**
     * @Route("/login/register")
     */
    public function registerAction() {
        $user = new User;
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->rend('GameBundle:Default:_register.html.twig', [
                        'form' => $form->createViews()
            ]);
        }
    }

}
