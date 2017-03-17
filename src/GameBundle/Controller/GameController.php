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
        $repo = $this->getDoctrine()->getRepository('GameBundle:Game');
        $oGame = $repo->findOneById($id);
        return $this->render('GameBundle:Game:detail.html.twig', array(
            'game' => $oGame,
            'nbusers' => count($oGame->getUsers())
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
        $oUser = $request->getSession()->get('user', NULL);
        if(!$oUser) { // not connected then return a login message
            return new Response(
                '<p class="alert-danger text-center">Vous devez vous connecter pour créer ou rejoindre une game !</p>'
            );
        }

        $oUser = $this->getDoctrine()->getRepository('GameBundle:User')->find($oUser->getId());

        $oGame = new Game();
        
        // form builder
        $form = $this->createFormBuilder($oGame)
            ->add('nameRoom', TextType::class)
            ->add('nbPlayerMax', ChoiceType::class, array(
                'choices'  => array('1' => 1, '2' => 2, '3' => 3, '4' => 4)))
            ->add('save', SubmitType::class, array('label' => 'Create Game'))
            ->getForm();
        $form->handleRequest($request);
        
        // test form datas (submitted and is valid)
        if ($form->isSubmitted() && $form->isValid()) {
            $oGame->setDate(new \DateTime());
            $oGame->addUser($oUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($oGame);
            $em->flush();
            return $this->redirectToRoute('game_game_join', ['id' => $oGame->getId(), 'game' => $oGame,
                'nbusers' => count($oGame->getUsers())]);
        }

       // Game Create
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

        // join the game if she's not full
        if (count($oGame->getUsers()) < $oGame->getNbPlayerMax()  ){

            $em = $this->getDoctrine()->getManager();
            $oUser = $em->getRepository('GameBundle:User')
                ->find($request->getSession()->get('user')->getId());
            $oGame->addUser($oUser); // add a user instance into $oGame
            //$oUser->setGame($oGame);
            $em->flush(); // save the game with the new player (user.gameid = game.id)
        }

        // game details view
        return $this->render('GameBundle:Game:detail.html.twig', array(
            'game' => $oGame,
            'nbusers' => count($oGame->getUsers())
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
            // init map if no saved game in $oGame object
            case 'init':
                if($oGame->getSaveGame() == NULL){
                    $oMap = new Map();
                    $initMapSer = $oMap->load();                    
                    $oGame->setSaveGame($initMapSer); 
                    $repo->flush(); // save the game into database
                }
                break;

            //move (used by ajax)
            case 'move':
                $oMapUnser = unserialize($oGame->getSaveGame()); // get map in a map object
                $oMapUnser->move($value);
                $oMapSer = serialize($oMapUnser);
                $oGame->setSaveGame($oMapSer);
                $repo->flush(); // save the game into database
                return $this->render('GameBundle:Map:map.html.twig', array('map' => $oMapUnser->getaElements()));
                break;
            //case 'shoot';
        }
        //dump($oGame);

        return $this->render('GameBundle:Game:play.html.twig', array(
            'idGame' => $id
        ));
    }
}
