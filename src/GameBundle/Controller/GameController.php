<?php

namespace GameBundle\Controller;

use ClassesWithParents\G;
use GameBundle\Entity\Game;
use GameBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        //RECUPERATION BDD
        $repo = $this->getDoctrine()->getRepository('GameBundle:Game');
        $oGame = $repo->findAll();

        //CALCUL PLAYERS RESTANTS

        //$oGame->

        return $this->render('GameBundle:Game:list.html.twig', array(
            'game' => $oGame
        ));
    }

    /**
     * @Route("/create")
     */
    public function createAction(Request $request)
    {
        //FORMULAIRE
        $idUser = 1;
        $oGame = new Game();
        $form = $this->createFormBuilder($oGame)
            ->add('nameRoom', TextType::class)
            ->add('nbPlayerMax', ChoiceType::class, array(
                'choices'  => array('1' => 1, '2' => 2, '3' => 3, '4' => 4)))
            ->add('save', SubmitType::class, array('label' => 'Create Game'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oGame->setDate(new \DateTime());
            $oGame->setIdUser($idUser);

            $em = $this->getDoctrine()->getManager();
            $em->persist($oGame);
            $em->flush();
            //RENVOI VERS LA LISTE DE GAME
            return $this->redirectToRoute('game_game_list');
            }


        return $this->render('GameBundle:Game:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("join/{id}")
     */
    public function joinAction($id)
    {
        $oUser = [];
        $oUser = array(array('id' => '1', 'pseudo' => 'Jean-Gui'),
                       array('id' => '2', 'pseudo' => 'Jean-Mi'),
                       );

        $repo = $this->getDoctrine()->getRepository('GameBundle:Game');
        $oGame = $repo->findOneById($id);

        //Rejoindre la partie si pas full
        if ($oGame->getNbPlayer() < $oGame->getNbPlayerMax()  ){
            $oGame->setNbPlayer($oGame->getNbPlayer() +1 );
            // METTRE le gameID dans USER  A FAIREEEEEEEEE
            //


            //RECUPERER USERS DE LA GAME SELECT BDD
            //liste d'objet à retourner

            //SAVE oGAME EN BDD
        }

        //A FAIRE VUE DETAIL GAME

        return $this->render('GameBundle:Game:join.html.twig', array(
            // Vue sur le détail de la Game avec oGame et oUsers
            'game' => $oGame,
            'user' => $oUser
        ));

    }

    /**
     * @Route("refresh/{id}")
     */
    public function refreshAction($id)
    {
        return $this->render('GameBundle:Game:refresh.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/play/{id}/{action}")
     */
    public function playAction($id, $action)
    {
        return $this->render('GameBundle:Game:play.html.twig', array(
            // ...
        ));
    }

}
