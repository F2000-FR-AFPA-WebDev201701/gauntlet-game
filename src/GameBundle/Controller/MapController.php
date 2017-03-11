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
        $this->perso1 = new Personage();
        $this->perso1->setPositionX(210);
        $this->perso1->setPositionY(190);
        $this->perso1->setType('hero'); // perso
        
        // load decor datas
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(110);
        $this->decor1->setPositionY(110);
        $this->decor1->setType('mur'); // wall
        $this->decor1->setImage('wall.gif');

        $oMap = new Map();
        $oMap->addElement($this->perso1);
        $oMap->addElement($this->decor1);

        //$this->save($this->oMap);
    
    
       // return $this->render('GameBundle:Map:initmap.html.twig', array('map' => $oMap->getaElements())
        //);
    }

}
