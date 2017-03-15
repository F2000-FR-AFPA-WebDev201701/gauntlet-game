<?php

namespace GameBundle\Controller;

use ClassesWithParents\G;
use GameBundle\Entity\Game;
use GameBundle\Entity\User;
use GameBundle\Model\Map;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    /**
     * @Route("/game/list")
     */
    public function listAction()
    {
        //RECUPERATION BDD
        $repo = $this->getDoctrine()->getRepository('GameBundle:Game');
        $oGame = $repo->findAll();

        return $this->render('GameBundle:Game:list.html.twig', array(
            'game' => $oGame
        ));
    }

    /**
     * @Route("/game/details/{id}")
     */
    public function detailAction($id)
    {
        //RECUPERATION BDD
        $repo = $this->getDoctrine()->getRepository('GameBundle:Game');
        $oGame = $repo->findOneById($id);
        dump($oGame);
        return $this->render('GameBundle:Game:detail.html.twig', array(
            'game' => $oGame
        ));
    }

    /**
     * @Route("/game/delete/{id}")
     */
    public function deleteAction($id)
    {
        //RECUPERATION BDD
        $repo = $this->getDoctrine()->getManager();
        $oGame = $repo->getRepository('GameBundle:Game')->findOneById($id);
        $repo->remove($oGame);
        $repo->flush();
        return $this->redirectToRoute('homepage');
    }



    /**
     * @Route("/game/create", name="game_create")
     */
    public function createAction(Request $request)
    {

        //FORMULAIRE
        $oUser = $request->getSession()->get('user', NULL);
        if(!$oUser) {
            return new Response();
        }

        $oUser = $this->getDoctrine()->getRepository('GameBundle:User')->find($oUser->getId());

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
            $oGame->addUser($oUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($oGame);
            $em->flush();
            //Renvoi vers la list sur homepage
            return $this->redirectToRoute('game_game_detail', ['id' => $oGame->getId()]);
            }

        //Render controller dans la homepage
       return $this->render('GameBundle:Game:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/game/join/{id}")
     */
    public function joinAction(Request $request, $id)
    {
        $oUser = $request->getSession()->get('user', NULL);
        if(!$oUser) {
            return new Response();
        }
        $repoGame = $this->getDoctrine()->getManager()->getRepository('GameBundle:Game');
        $oGame = $repoGame->findOneById($id);

        //Rejoindre la partie si pas full
        if (count($oGame->getUsers()) < $oGame->getNbPlayerMax()  ){

            // METTRE le gameID dans USER  A FAIREEEEEEEEE
            $em = $this->getDoctrine()->getManager();
            $oUser = $em->getRepository('GameBundle:User')
                ->find($request->getSession()->get('user')->getId());
            $oUser->setGame($oGame);
            //$oGame->addUser($oUser);
            $em->flush();
            //RECUPERER USERS DE LA GAME SELECT BDD
            //liste d'objet à retourner
            //$oGame->getUsers();
            //SAVE oGAME EN BDD
        }

        //////RENDER CONTROLLER DETAIL DANS HOMEPAGE//////
        return $this->render('GameBundle:Game:detail.html.twig', array(
            // Vue sur le détail de la Game avec oGame et oUsers
            'game' => $oGame,
            'users' => $oGame->getUsers()
        ));

    }


    /**
     * @Route("/game/play/{id}/{action}/{value}")
     */
    public function playAction($id, $action, $value = NULL)
    {
        $repo = $this->getDoctrine()->getManager();
        $oGame = $repo->getRepository('GameBundle:Game')->findOneById($id);


        switch ($action){
            //Afficher la map (action create)
            case 'init':
                if($oGame->getSaveGame() == NULL){
                    $oMap = new Map(1);
                    $initMap = $oMap->load();
                    $initMapSer = serialize($initMap);
                    $oGame->setSaveGame($initMapSer);
                    dump($initMap);
                    dump($initMapSer);
                    //Sauvegarde en base
                    $repo->flush();
                }
                break;

             //AJAX de move
            case 'move':
                $oMapUnser = unserialize($oGame->getSaveGame());
                $oMapUnser->move($value);
                $oMapSer = serialize($oMapUnser);
                $oGame->setSaveGame($oMapSer);
                $repo->flush();
                break;
            //case 'shoot';     SHOOT A FAIRE
        }

        //Insert map(saveGame) dans l'instance Game



        dump($oGame);

        return $this->render('GameBundle:Game:play.html.twig', array(
            'idGame' => $id
        ));
    }




}
