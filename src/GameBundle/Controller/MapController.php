<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Map;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller {

    /**
     * @Route("/initmap")
     */
    public function initmapAction() {
        $map = array(
            1 => array(
                'coordx' => '128',
                'coordy' => '128',
                'tuile' => 'mur',
            ),
            2 => array(
                'coordx' => '160',
                'coordy' => '128',
                'tuile' => 'mur',
            ),
            3 => array(
                'coordx' => '384',
                'coordy' => '352',
                'tuile' => 'mur',
            ),
            4 => array(
                'coordx' => '384',
                'coordy' => '384',
                'tuile' => 'mur',
            ),
            5 => array(
                'coordx' => '192',
                'coordy' => '128',
                'tuile' => 'mur',
            ),
            6 => array(
                'coordx' => '64',
                'coordy' => '64',
                'tuile' => 'hero',
            )
        );

        $oMap = new Map();
        $oMap->addElement(array(
            'coordx' => '64',
            'coordy' => '64',
            'tuile' => 'hero'
        ));
        $oMap->addElement(array(
            'coordx' => '168',
            'coordy' => '168',
            'tuile' => 'mur'
        ));

        return $this->render('GameBundle:Map:initmap.html.twig', array('map' => $oMap->getaElements())
        );
    }

}
