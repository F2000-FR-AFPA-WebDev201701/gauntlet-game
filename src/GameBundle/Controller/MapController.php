<?php

namespace GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GameBundle\Model\Map;
use GameBundle\Model\Personage;
use GameBundle\Model\Decor;
use GameBundle\Model\Item;
use GameBundle\Model\Monster;

class MapController extends Controller {

    /**
     * @Route("/create_map_file")
     * createMapAction()
     * it's a map generator : create some map into a file
     * ADMIN only
     */
    public function CreateMapAction() {
        // map 1
        // *****
        // perso
        $this->perso1 = new Personage();
        $this->perso1->setPositionX(210);
        $this->perso1->setPositionY(190);
        $this->perso1->setType('hero');
        $this->perso1->setHp(100);
        $this->perso1->setScore(0);

        // decors
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(64);
        $this->decor1->setPositionY(64);
        $this->decor1->setType('wallyxr'); // wall
        //
        // $this->decor1 = new Decor();
        $this->decor2->setPositionX(64);
        $this->decor2->setPositionY(96);
        $this->decor2->setType('wally'); // wall
        //
        // $this->decor1 = new Decor();
        $this->decor3->setPositionX(64);
        $this->decor3->setPositionY(128);
        $this->decor3->setType('wally'); // wall
        //
        // $this->decor1 = new Decor();
        $this->decor4->setPositionX(64);
        $this->decor4->setPositionY(160);
        $this->decor4->setType('wallybt'); // wall
        //
        // $this->decor1 = new Decor();
        $this->decor5->setPositionX(192);
        $this->decor5->setPositionY(160);
        $this->decor5->setType('wally'); // wall
        //
        // $this->decor1 = new Decor();
        $this->decor6->setPositionX(192);
        $this->decor6->setPositionY(192);
        $this->decor6->setType('wally'); // wall
        //
        // $this->decor1 = new Decor();
        $this->decor7->setPositionX(192);
        $this->decor7->setPositionY(224);
        $this->decor7->setType('wally'); // wall
        //// $this->decor1 = new Decor();
        $this->decor8->setPositionX(192);
        $this->decor8->setPositionY(256);
        $this->decor8->setType('wallxrt'); // wall
        //// $this->decor1 = new Decor();
        $this->decor9->setPositionX(160);
        $this->decor9->setPositionY(256);
        $this->decor9->setType('wallx'); // wall
        //// $this->decor1 = new Decor();
        $this->decor10->setPositionX(128);
        $this->decor10->setPositionY(224);
        $this->decor10->setType('wallxlt'); // wall
        // items
        $this->item1 = new Item();
        $this->item1->setPositionX(200);
        $this->item1->setPositionY(260);
        $this->item1->setType('potion');
        //monsters
        $this->monster1 = new Monster();
        $this->monster1->setPositionX(100);
        $this->monster1->setPositionY(10);
        $this->monster1->setHp(100);
        $this->monster1->setType('ghost');

        $oMap1 = new Map();
        $oMap1->addElementCharacter($this->perso1);
        $oMap1->addElementDecor($this->decor1);
        $oMap1->addElementItem($this->item1);
        $oMap1->addElementMonster($this->monster1);

        $oMap1->save(1);

        // map 2
        $this->perso1 = new Personage();
        $this->perso1->setPositionX(250);
        $this->perso1->setPositionY(140);
        $this->perso1->setType('hero'); // perso
        // load decor datas
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(90);
        $this->decor1->setPositionY(100);
        $this->decor1->setType('mur'); // wall

        $this->decor2 = new Decor();
        $this->decor2->setPositionX(100);
        $this->decor2->setPositionY(160);
        $this->decor2->setType('mur'); // wall

        $oMap2 = new Map();
        $oMap2->addElementCharacter($this->perso1);
        $oMap2->addElementDecor($this->decor1);
        $oMap2->addElementDecor($this->decor2);

        $oMap2->save(2);

        //dump($oMap1);
        //dump($oMap2);
        $nbMaps = $oMap1->nbMaps();
        return $this->render('GameBundle:Map:create.html.twig', array('nbMaps' => $nbMaps)
        );
    }

    /**
     * @Route("/delete_map_file")
     * deleteMapAction()
     * delete all maps (initial & save)
     * ADMIN only
     */
    public function deleteMapAction() {
        $oMap = new Map();
        $oMap->delete();

        $nbMaps = $oMap->nbMaps();

        return $this->render('GameBundle:Map:delete.html.twig', array('nbMaps' => $nbMaps)
        );
    }

}
