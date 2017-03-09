<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Model\Decor;
use GameBundle\Model\Personage;
use GameBundle\Model\Map;

class DefaultController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        return $this->render('GameBundle:Default:index.html.twig');
    }

    /**
     * @Route("/tests")
     */
    public function testsAction() {

        // load decor datas
        $decor1 = new Decor();
        $decor1->setPositionX(123);
        $decor1->setPositionY(22);
        $decor1->setType('mur'); // wall
        $decor1->setImage('wall.gif');

        $decor2 = new Decor();
        $decor2->setPositionX(72);
        $decor2->setPositionY(44);
        $decor2->setType('mur'); // wall
        $decor2->setImage('wall.gif');

        $perso1 = new Personage();
        $perso1->setPositionX(155);
        $perso1->setPositionY(175);
        $perso1->setType('hero'); // perso
        //$perso1->setImage('war.gif');

        $oMap = new Map();
        $oMap->addElement($decor1);
        $oMap->addElement($decor2);

        $oMap->addElement($perso1);

        dump($decor1);
        dump($decor2);

        dump($oMap->getaElements());

        //$oMap->collision($perso1, $decor2);

        return $this->render('GameBundle:Map:initmap.html.twig', array('map' => $oMap->getaElements()));
    }

}
