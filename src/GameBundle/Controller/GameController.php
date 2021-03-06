<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Game;
use GameBundle\Model\Map;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller {

    /**
     * @Route("/game/list")
     */
    public function listAction() {
        $repo = $this->getDoctrine()->getRepository('GameBundle:Game');
        $oGame = $repo->findAll(array('status' => 'DESC', 'score' => 'DESC'));

        return $this->render('GameBundle:Game:list.html.twig', array(
                    'game' => $oGame
        ));
    }

    /**
     * @Route("/game/details/{id}")
     */
    public function detailAction($id) {
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
    public function deleteAction($id) {
        $repo = $this->getDoctrine()->getManager();
        $oGame = $repo->getRepository('GameBundle:Game')->findOneById($id);
        $repo->remove($oGame);
        $repo->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/game/create", name="game_create")
     */
    public function createAction(Request $request) {
        $oUser = $request->getSession()->get('user', NULL);
        if (!$oUser) { // not connected then return a login message
            return new Response(
                    '<p class="alert-danger text-center">Vous devez vous connecter pour créer ou rejoindre une game !</p>'
            );
        }

        $oUser = $this->getDoctrine()->getRepository('GameBundle:User')->find($oUser->getId());

        if ($oUser->getGame()) {
            return new Response(
                    '<p class="alert-danger text-center">Vous avez déjà une game !</p>'
            );
        }

        $oGame = new Game();

        // form builder
        $form = $this->createFormBuilder($oGame)
                ->add('nameRoom', TextType::class, array('label' => 'Nom'))
                ->add('nbPlayerMax', ChoiceType::class, array('label' => 'Joueurs',
                    'choices' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4)))
                ->add('save', SubmitType::class, array('label' => 'Créer une Game'))
                ->getForm();
        $form->handleRequest($request);

        // test form datas (submitted and is valid)
        if ($form->isSubmitted() && $form->isValid()) {
            $oGame->setDate(new \DateTime());
            $oGame->addUser($oUser);
            $oUser->setGame($oGame);
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
     * @Route("/game/join/{id}", defaults={"_fragment" = "game-section"})
     */
    public function joinAction(Request $request, $id) {
        $oUser = $request->getSession()->get('user', NULL);
        if (!$oUser) {
            return new Response();
        }
        $repoGame = $this->getDoctrine()->getManager()->getRepository('GameBundle:Game');
        $oGame = $repoGame->findOneById($id);

        // join the game if she's not full
        if (count($oGame->getUsers()) < $oGame->getNbPlayerMax()) {
            $em = $this->getDoctrine()->getManager();
            $oUser = $em->getRepository('GameBundle:User')
                    ->find($request->getSession()->get('user')->getId());
            $oGame->addUser($oUser); // add a user instance into $oGame
            $oUser->setGame($oGame);
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
    public function playAction(Request $request, $id, $action, $value = NULL) {
        $em = $this->getDoctrine()->getManager();
        $oGame = $this->getDoctrine()->getRepository('GameBundle:Game')->findOneById($id);

        switch ($action) {
            // init map if no saved game in $oGame object
            case 'init':
                if (!$oGame->getSaveGame()) {
                    $oMap = new Map();
                    $initMapSer = $oMap->load(); // load map from file (mapX.initial)
                    $oGame->setSaveGame($initMapSer);
                    $oGame->setStatus(1);
                    $em->flush(); // save the game into database
                    $oMap = unserialize($initMapSer);
                } else {
                    $oMap = unserialize($oGame->getSaveGame()); // read gamesave from database
                    if($oGame->getStatus() == 2) {
                        return $this->render('GameBundle:Game:play.html.twig', array('idGame' => $id, 'text' => 'Cette Game est terminée !!!', 'player' => $oMap->getaElementsCharacters()[0], 'map' => $oMap->getaElements()));
                    }
                }

                return $this->render('GameBundle:Game:play.html.twig', array('idGame' => $id, 'player' => $oMap->getaElementsCharacters()[0], 'map' => $oMap->getaElements()));

            //move (used by ajax)
            case 'move':
                $oMapUnser = unserialize($oGame->getSaveGame()); // get a map object
                $oMapUnser->move($value); // do the move
                $oMapSer = serialize($oMapUnser); // serialize (prepare to save into database)
                $oGame->setSaveGame($oMapSer);
                
                // death (character)
                if ($oMapUnser->getaElementsCharacters()[0]->getHp() <= 0) {
                    $this->deadOrWin($request, $oGame, $oMapUnser);
                    $em->flush(); // save the game into database
                    
                    return $this->render('GameBundle:Map:map.html.twig', $this->aMapRenderText($oMapUnser, 'Vous êtes mort !!!'));
                }

                // next level
                if ($oMapUnser->isNextlvl()) {
                    $nextLevel = $oMapUnser->getCurrentLvl() + 1;
                    // test if this's the end ?
                    if ($nextLevel > $oMapUnser->nbMaps()) {
                        $this->deadOrWin($request, $oGame, $oMapUnser);
                        $em->flush(); // save the game into database
                        
                        return $this->render('GameBundle:Map:map.html.twig', $this->aMapRenderText($oMapUnser, 'Vous avez Gagné !!!'));
                    }
                    // no end the go to next level
                    $oMap = new Map();
                    $initMapSerNext = $oMap->load($nextLevel); // load map from file (mapX.initial)
                    $oMapUnserNext = unserialize($initMapSerNext);
                    $oMapUnserNext->setaElementsCharacters($oMapUnser->getaElementsCharacters()); // save hp & score...
                    $oMapUnser->getaElementsCharacters()[0]->setClef(false); // remove clef
                    $initMapSerNext = serialize($oMapUnserNext);
                    $oGame->setSaveGame($initMapSerNext);
                    $oGame->setStatus(1);
                }

                $em->flush(); // save the game into database
                
                return $this->render('GameBundle:Map:map.html.twig', $this->aMapRender($oMapUnser));

            case 'shoot':
                $oMapUnser = unserialize($oGame->getSaveGame()); // get a map object
                $oMapUnser->attack();
                $oMapSer = serialize($oMapUnser); // serialize (prepare to save into database)
                $oGame->setSaveGame($oMapSer);
                $em->flush(); // save the game into database
                
                return $this->render('GameBundle:Map:map.html.twig', $this->aMapRender($oMapUnser));
        }

        return new Response('Map : Problème!');
    }
    
    /*
     * aMapRenderText
     *
     **/
    private function aMapRenderText($oMap, $text = null) {
        $result = array();
        $result = $this->aMapRender($oMap);
        $result['text'] = $text;
        
        return $result;
    }

    /*
     * aMapRender
     *
     **/
    private function aMapRender($oMap) {
        return array(
            'map' => $oMap->getaElements(),
            'player' => $oMap->getaElementsCharacters()[0]
        );
    }
    
    /*
     * deadOrWin
     * set game at null in user table
     * set status à 2 in game table
     * set score in game table (hiscore)
     *
     **/
    private function deadOrWin($request, $oGame, $oMap) {
        $oUser = $this->getDoctrine()->getRepository('GameBundle:User')
                    ->find($request->getSession()->get('user')->getId());
        $oUser->setGame(null);
        $oGame->setStatus(2);
        $oGame->setScore($oMap->getaElementsCharacters()[0]->getScore()); // save Game Hiscore
    }

}
