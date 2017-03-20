<?php

namespace GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GameBundle\Model\Decor;
use GameBundle\Model\Personage;
use GameBundle\Model\Item;
use GameBundle\Model\Map;

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
        $this->decor1->setPositionX(110);
        $this->decor1->setPositionY(110);
        $this->decor1->setType('mur'); // wall
        // items
        $this->item1 = new Item();
        $this->item1->setPositionX(200);
        $this->item1->setPositionY(260);
        $this->item1->setType('potion');

        $oMap1 = new Map();
        $oMap1->addElementCharacter($this->perso1);
        $oMap1->addElementDecor($this->decor1);
        $oMap1->addElementItem($this->item1);

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
