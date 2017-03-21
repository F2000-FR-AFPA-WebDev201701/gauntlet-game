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
        $this->perso1->setPositionX(185);
        $this->perso1->setPositionY(5);
        $this->perso1->setType('hero');
        $this->perso1->setHp(100);
        $this->perso1->setScore(0);

        // decors
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(128);
        $this->decor1->setPositionY(128);
        $this->decor1->setType('wallyxr'); // wall
        //
        $this->decor2 = new Decor();
        $this->decor2->setPositionX(128);
        $this->decor2->setPositionY(192);
        $this->decor2->setType('wally'); // wall
        //
        $this->decor3 = new Decor();
        $this->decor3->setPositionX(128);
        $this->decor3->setPositionY(256);
        $this->decor3->setType('wally'); // wall
        //
        $this->decor4 = new Decor();
        $this->decor4->setPositionX(128);
        $this->decor4->setPositionY(320);
        $this->decor4->setType('wallybt'); // wall
        //
        $this->decor5 = new Decor();
        $this->decor5->setPositionX(384);
        $this->decor5->setPositionY(256);
        $this->decor5->setType('wallyxr'); // wall
        //
        $this->decor6 = new Decor();
        $this->decor6->setPositionX(384);
        $this->decor6->setPositionY(320);
        $this->decor6->setType('wally'); // wall
        //
        $this->decor7 = new Decor();
        $this->decor7->setPositionX(384);
        $this->decor7->setPositionY(384);
        $this->decor7->setType('wally'); // wall

        $this->decor8 = new Decor();
        $this->decor8->setPositionX(384);
        $this->decor8->setPositionY(448);
        $this->decor8->setType('wallxrt'); // wall xrt

        $this->decor9 = new Decor();
        $this->decor9->setPositionX(320);
        $this->decor9->setPositionY(448);
        $this->decor9->setType('wallx'); // wall
        //
        $this->decor10 = new Decor();
        $this->decor10->setPositionX(256);
        $this->decor10->setPositionY(448);
        $this->decor10->setType('wallxlt'); // wall
        // items
        $this->decor11 = new Decor();
        $this->decor11->setPositionX(192);
        $this->decor11->setPositionY(128);
        $this->decor11->setType('wallx'); // wall
        // items
        $this->decor12 = new Decor();
        $this->decor12->setPositionX(256);
        $this->decor12->setPositionY(128);
        $this->decor12->setType('wallxrt'); // wall
        // items
        $this->decor13 = new Decor();
        $this->decor13->setPositionX(448);
        $this->decor13->setPositionY(256);
        $this->decor13->setType('wallx'); // wall
        // items
        $this->decor14 = new Decor();
        $this->decor14->setPositionX(512);
        $this->decor14->setPositionY(256);
        $this->decor14->setType('wallx'); // wall
        // items
        $this->decor15 = new Decor();
        $this->decor15->setPositionX(576);
        $this->decor15->setPositionY(256);
        $this->decor15->setType('wallx'); // wall
        // items
        $this->decor16 = new Decor();
        $this->decor16->setPositionX(256);
        $this->decor16->setPositionY(64);
        $this->decor16->setType('wally'); // wall
        // items
        $this->decor17 = new Decor();
        $this->decor17->setPositionX(256);
        $this->decor17->setPositionY(0);
        $this->decor17->setType('wally'); // wall
        // items
        $this->decor18 = new Decor();
        $this->decor18->setPositionX(640);
        $this->decor18->setPositionY(256);
        $this->decor18->setType('wallx'); // wall
        // items
        $this->decor19 = new Decor();
        $this->decor19->setPositionX(704);
        $this->decor19->setPositionY(256);
        $this->decor19->setType('wallx'); // wall
        // items
        $this->decor20 = new Decor();
        $this->decor20->setPositionX(512);
        $this->decor20->setPositionY(192);
        $this->decor20->setType('wally'); // wall
        // items
        $this->decor21 = new Decor();
        $this->decor21->setPositionX(512);
        $this->decor21->setPositionY(192);
        $this->decor21->setType('wally'); // wall
        // items
        $this->decor22 = new Decor();
        $this->decor22->setPositionX(512);
        $this->decor22->setPositionY(128);
        $this->decor22->setType('wallyxr'); // wall
        // items
        $this->decor23 = new Decor();
        $this->decor23->setPositionX(576);
        $this->decor23->setPositionY(128);
        $this->decor23->setType('wallxrt'); // wall
        // items


        $this->item1 = new Item();
        $this->item1->setPositionX(256);
        $this->item1->setPositionY(256);
        $this->item1->setType('potion');
        // items


        $this->item2 = new Item();
        $this->item2->setPositionX(576);
        $this->item2->setPositionY(192);
        $this->item2->setType('clef');
        //monsters
        //
        //monsters
        $this->monster1 = new Monster();
        $this->monster1->setPositionX(64);
        $this->monster1->setPositionY(448);
        $this->monster1->setHp(100);
        $this->monster1->setType('ghost');
        //monsters
        $this->monster2 = new Monster();
        $this->monster2->setPositionX(448);
        $this->monster2->setPositionY(320);
        $this->monster2->setHp(100);
        $this->monster2->setType('ghost');
        //monsters
        $this->monster3 = new Monster();
        $this->monster3->setPositionX(320);
        $this->monster3->setPositionY(0);
        $this->monster3->setHp(100);
        $this->monster3->setType('ghost');
        //monsters
        $this->monster4 = new Monster();
        $this->monster4->setPositionX(512);
        $this->monster4->setPositionY(64);
        $this->monster4->setHp(100);
        $this->monster4->setType('ghost');

        $oMap1 = new Map();
        $oMap1->addElementCharacter($this->perso1);
        $oMap1->addElementDecor($this->decor1);
        $oMap1->addElementDecor($this->decor2);
        $oMap1->addElementDecor($this->decor3);
        $oMap1->addElementDecor($this->decor4);
        $oMap1->addElementDecor($this->decor5);
        $oMap1->addElementDecor($this->decor6);
        $oMap1->addElementDecor($this->decor7);
        $oMap1->addElementDecor($this->decor8);
        $oMap1->addElementDecor($this->decor9);
        $oMap1->addElementDecor($this->decor10);
        $oMap1->addElementDecor($this->decor11);
        $oMap1->addElementDecor($this->decor12);
        $oMap1->addElementDecor($this->decor13);
        $oMap1->addElementDecor($this->decor14);
        $oMap1->addElementDecor($this->decor15);
        $oMap1->addElementDecor($this->decor16);
        $oMap1->addElementDecor($this->decor17);
        $oMap1->addElementDecor($this->decor18);
        $oMap1->addElementDecor($this->decor19);
        $oMap1->addElementDecor($this->decor20);
        $oMap1->addElementDecor($this->decor21);
        $oMap1->addElementDecor($this->decor22);
        $oMap1->addElementDecor($this->decor23);
        $oMap1->addElementItem($this->item1);
        $oMap1->addElementItem($this->item2);
        $oMap1->addElementMonster($this->monster1);
        $oMap1->addElementMonster($this->monster2);
        $oMap1->addElementMonster($this->monster3);
        $oMap1->addElementMonster($this->monster4);

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
