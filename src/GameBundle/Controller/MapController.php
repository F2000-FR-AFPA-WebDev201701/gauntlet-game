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
        $this->perso1->setPositionX(6);
        $this->perso1->setPositionY(6);
        $this->perso1->setType('hero');
        $this->perso1->setHp(100);
        $this->perso1->setScore(0);

        // decors
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(128);
        $this->decor1->setPositionY(128);
        $this->decor1->setType('wallyxr'); // wall

        $this->decor2 = new Decor();
        $this->decor2->setPositionX(128);
        $this->decor2->setPositionY(192);
        $this->decor2->setType('wally'); // wall

        $this->decor3 = new Decor();
        $this->decor3->setPositionX(128);
        $this->decor3->setPositionY(256);
        $this->decor3->setType('wally'); // wall

        $this->decor4 = new Decor();
        $this->decor4->setPositionX(128);
        $this->decor4->setPositionY(320);
        $this->decor4->setType('wallybt'); // wall

        $this->decor5 = new Decor();
        $this->decor5->setPositionX(384);
        $this->decor5->setPositionY(256);
        $this->decor5->setType('wallyxr'); // wall

        $this->decor6 = new Decor();
        $this->decor6->setPositionX(384);
        $this->decor6->setPositionY(320);
        $this->decor6->setType('wally'); // wall

        $this->decor7 = new Decor();
        $this->decor7->setPositionX(384);
        $this->decor7->setPositionY(384);
        $this->decor7->setType('wallxrt'); // wall

        $this->decor8 = new Decor();
        $this->decor8->setPositionX(320);
        $this->decor8->setPositionY(384);
        $this->decor8->setType('wallxlt'); // wall

        $this->decor9 = new Decor();
        $this->decor9->setPositionX(192);
        $this->decor9->setPositionY(128);
        $this->decor9->setType('wallxrt'); // wall

        $this->decor10 = new Decor();
        $this->decor10->setPositionX(448);
        $this->decor10->setPositionY(256);
        $this->decor10->setType('wallx'); // wall

        $this->decor11 = new Decor();
        $this->decor11->setPositionX(512);
        $this->decor11->setPositionY(256);
        $this->decor11->setType('wallx'); // wall

        $this->decor12 = new Decor();
        $this->decor12->setPositionX(576);
        $this->decor12->setPositionY(256);
        $this->decor12->setType('wallx'); // wall

        $this->decor13 = new Decor();
        $this->decor13->setPositionX(192);
        $this->decor13->setPositionY(64);
        $this->decor13->setType('wally'); // wall

        $this->decor14 = new Decor();
        $this->decor14->setPositionX(192);
        $this->decor14->setPositionY(0);
        $this->decor14->setType('wally'); // wall

        $this->decor15 = new Decor();
        $this->decor15->setPositionX(640);
        $this->decor15->setPositionY(256);
        $this->decor15->setType('wallx'); // wall

        $this->decor16 = new Decor();
        $this->decor16->setPositionX(704);
        $this->decor16->setPositionY(256);
        $this->decor16->setType('wallx'); // wall

        $this->decor17 = new Decor();
        $this->decor17->setPositionX(512);
        $this->decor17->setPositionY(192);
        $this->decor17->setType('wally'); // wall

        $this->decor18 = new Decor();
        $this->decor18->setPositionX(512);
        $this->decor18->setPositionY(192);
        $this->decor18->setType('wally'); // wall

        $this->decor19 = new Decor();
        $this->decor19->setPositionX(512);
        $this->decor19->setPositionY(128);
        $this->decor19->setType('wallyb'); // wall

        // items
        $this->item1 = new Item();
        $this->item1->setPositionX(192);
        $this->item1->setPositionY(192);
        $this->item1->setType('potion');

        $this->item2 = new Item();
        $this->item2->setPositionX(576);
        $this->item2->setPositionY(192);
        $this->item2->setType('clef');

        $this->item3 = new Item();
        $this->item3->setPositionX(320);
        $this->item3->setPositionY(320);
        $this->item3->setType('diamant');

        $this->item4 = new Item();
        $this->item4->setPositionX(640);
        $this->item4->setPositionY(384);
        $this->item4->setType('nextlvl');
        
        // monsters
        $this->monster1 = new Monster();
        $this->monster1->setPositionX(64);
        $this->monster1->setPositionY(448);
        $this->monster1->setHp(100);
        $this->monster1->setType('ghost');

        $this->monster2 = new Monster();
        $this->monster2->setPositionX(448);
        $this->monster2->setPositionY(320);
        $this->monster2->setHp(100);
        $this->monster2->setType('ghost');

        $this->monster3 = new Monster();
        $this->monster3->setPositionX(320);
        $this->monster3->setPositionY(0);
        $this->monster3->setHp(100);
        $this->monster3->setType('ghost');

        $this->monster4 = new Monster();
        $this->monster4->setPositionX(512);
        $this->monster4->setPositionY(64);
        $this->monster4->setHp(100);
        $this->monster4->setType('ghost');

        $this->monster5 = new Monster();
        $this->monster5->setPositionX(640);
        $this->monster5->setPositionY(128);
        $this->monster5->setHp(100);
        $this->monster5->setType('ghost');

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

        $oMap1->addElementItem($this->item1);
        $oMap1->addElementItem($this->item2);
        $oMap1->addElementItem($this->item3);
        $oMap1->addElementItem($this->item4);
        
        $oMap1->addElementMonster($this->monster1);
        $oMap1->addElementMonster($this->monster2);
        $oMap1->addElementMonster($this->monster3);
        $oMap1->addElementMonster($this->monster4);
        $oMap1->addElementMonster($this->monster5);

        $oMap1->save(1);

        
        // map 2
        // *****

        $this->perso01 = new Personage();
        $this->perso01->setPositionX(660);
        $this->perso01->setPositionY(460);
        $this->perso01->setType('hero');
        $this->perso01->setHp(100);
        $this->perso01->setScore(0);

        // decors
        $this->decor01 = new Decor();
        $this->decor01->setPositionX(0);
        $this->decor01->setPositionY(192);
        $this->decor01->setType('wallx'); // wall
        
        $this->decor02 = new Decor();
        $this->decor02->setPositionX(64);
        $this->decor02->setPositionY(192);
        $this->decor02->setType('wallx'); // wall

        $this->decor03 = new Decor();
        $this->decor03->setPositionX(128);
        $this->decor03->setPositionY(192);
        $this->decor03->setType('wallxrt'); // wall
        
        $this->decor04 = new Decor(); //2nd mur
        $this->decor04->setPositionX(384);
        $this->decor04->setPositionY(0);
        $this->decor04->setType('wally'); // wall

        $this->decor05 = new Decor();
        $this->decor05->setPositionX(384);
        $this->decor05->setPositionY(64);
        $this->decor05->setType('wally'); // wall

        $this->decor06 = new Decor();
        $this->decor06->setPositionX(384);
        $this->decor06->setPositionY(128);
        $this->decor06->setType('wallxyx'); // wall

        $this->decor07 = new Decor();
        $this->decor07->setPositionX(320);
        $this->decor07->setPositionY(128);
        $this->decor07->setType('wallxlt'); // wall

        $this->decor08 = new Decor();
        $this->decor08->setPositionX(384);
        $this->decor08->setPositionY(192);
        $this->decor08->setType('wallybt'); // wall xrt

        $this->decor09 = new Decor();
        $this->decor09->setPositionX(448);
        $this->decor09->setPositionY(128);
        $this->decor09->setType('wallxrt'); // wall

        $this->decor010 = new Decor(); //mur 3
        $this->decor010->setPositionX(640);
        $this->decor010->setPositionY(128);
        $this->decor010->setType('wallxlt'); // wall

        $this->decor011 = new Decor();
        $this->decor011->setPositionX(704);
        $this->decor011->setPositionY(128);
        $this->decor011->setType('wallx'); // wall

        $this->decor012 = new Decor(); //mur 4
        $this->decor012->setPositionX(192);
        $this->decor012->setPositionY(384);
        $this->decor012->setType('wallxlt'); // wall

        $this->decor013 = new Decor();
        $this->decor013->setPositionX(256);
        $this->decor013->setPositionY(384);
        $this->decor013->setType('wallx'); // wall

        $this->decor014 = new Decor();
        $this->decor014->setPositionX(320);
        $this->decor014->setPositionY(384);
        $this->decor014->setType('wallxrt'); // wall

        $this->decor015 = new Decor();
        $this->decor015->setPositionX(512);
        $this->decor015->setPositionY(384);
        $this->decor015->setType('wallxlt'); // wall

        $this->decor016 = new Decor();
        $this->decor016->setPositionX(576);
        $this->decor016->setPositionY(384);
        $this->decor016->setType('wallx'); // wall

        $this->decor017 = new Decor();
        $this->decor017->setPositionX(640);
        $this->decor017->setPositionY(384);
        $this->decor017->setType('wallx'); // wall

        $this->decor018 = new Decor();
        $this->decor018->setPositionX(704);
        $this->decor018->setPositionY(384);
        $this->decor018->setType('wallx'); // wall

        // items
        $this->item01 = new Item();
        $this->item01->setPositionX(0);
        $this->item01->setPositionY(384);
        $this->item01->setType('potion');

        $this->item02 = new Item();
        $this->item02->setPositionX(704);
        $this->item02->setPositionY(0);
        $this->item02->setType('clef');
        
        $this->item03 = new Item();
        $this->item03->setPositionX(0);
        $this->item03->setPositionY(64);
        $this->item03->setType('nextlvl'); // nextlvl

        // monsters
        $this->monster01 = new Monster();
        $this->monster01->setPositionX(256);
        $this->monster01->setPositionY(0);
        $this->monster01->setHp(100);
        $this->monster01->setType('ghost');

        $this->monster02 = new Monster();
        $this->monster02->setPositionX(64);
        $this->monster02->setPositionY(128);
        $this->monster02->setHp(100);
        $this->monster02->setType('ghost');

        $this->monster03 = new Monster();
        $this->monster03->setPositionX(704);
        $this->monster03->setPositionY(192);
        $this->monster03->setHp(100);
        $this->monster03->setType('ghost');

        $this->monster04 = new Monster();
        $this->monster04->setPositionX(576);
        $this->monster04->setPositionY(320);
        $this->monster04->setHp(100);
        $this->monster04->setType('ghost');

        $this->monster05 = new Monster();
        $this->monster05->setPositionX(256);
        $this->monster05->setPositionY(448);
        $this->monster05->setHp(100);
        $this->monster05->setType('ghost');

        $oMap2 = new Map();
        $oMap2->addElementCharacter($this->perso01);
        
        $oMap2->addElementDecor($this->decor01);
        $oMap2->addElementDecor($this->decor02);
        $oMap2->addElementDecor($this->decor03);
        $oMap2->addElementDecor($this->decor04);
        $oMap2->addElementDecor($this->decor05);
        $oMap2->addElementDecor($this->decor06);
        $oMap2->addElementDecor($this->decor07);
        $oMap2->addElementDecor($this->decor08);
        $oMap2->addElementDecor($this->decor09);
        $oMap2->addElementDecor($this->decor010);
        $oMap2->addElementDecor($this->decor011);
        $oMap2->addElementDecor($this->decor012);
        $oMap2->addElementDecor($this->decor013);
        $oMap2->addElementDecor($this->decor014);
        $oMap2->addElementDecor($this->decor015);
        $oMap2->addElementDecor($this->decor016);
        $oMap2->addElementDecor($this->decor017);
        $oMap2->addElementDecor($this->decor018);

        $oMap2->addElementItem($this->item01);
        $oMap2->addElementItem($this->item02);
        $oMap2->addElementItem($this->item03);
        
        $oMap2->addElementMonster($this->monster01);
        $oMap2->addElementMonster($this->monster02);
        $oMap2->addElementMonster($this->monster03);
        $oMap2->addElementMonster($this->monster04);
        $oMap2->addElementMonster($this->monster05);

        $oMap2->save(2);

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
