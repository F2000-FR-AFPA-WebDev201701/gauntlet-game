<?php

namespace GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GameBundle\Model\Decor;
use GameBundle\Model\Personage;
use GameBundle\Model\Map;

class MapController extends Controller {

    /**
     * @Route("/create_map_file")
     * createMapAction()
     * it's a map generator : create some map into a file
     */
    public function CreateMapAction() {
        // map 1
        $this->perso1 = new Personage();
        $this->perso1->setPositionX(210);
        $this->perso1->setPositionY(190);
        $this->perso1->setType('hero'); // perso
        // load decor datas
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(110);
        $this->decor1->setPositionY(110);
        $this->decor1->setType('mur'); // wall

        $oMap1 = new Map(1);
        $oMap1->addElement($this->perso1);
        $oMap1->addElement($this->decor1);

        $oMap1->save(true);

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

        $oMap2 = new Map(2);
        $oMap2->addElement($this->perso1);
        $oMap2->addElement($this->decor1);
        $oMap2->addElement($this->decor2);

        $oMap2->save(true);

        //dump($oMap1);
        //dump($oMap2);

        return $this->render('GameBundle:Map:template.html.twig', array('map' => $oMap2->getaElements())
        );
    }

}
