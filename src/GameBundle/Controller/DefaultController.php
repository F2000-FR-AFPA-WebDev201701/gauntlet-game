<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Model\Decor;
use GameBundle\Model\Personage;
use GameBundle\Model\Map;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        //dump($request->getSession()->get("user"));
        return $this->render('GameBundle:Default:index.html.twig');
    }

    /**
     * @Route("/tests/map-{id}")
     */
    public function testsAction($id) {
        $this->oMap = new Map($id);
        if ($this->oMap->nbMaps() <= 0) {
            $oMaps = "no Maps";
        } else {
            $unserFile = $this->oMap->load();
            $this->oMap = $unserFile;
            $oMaps = $this->oMap->getaElements();
        }

        return $this->render('GameBundle:Map:template.html.twig', array(
                    'map' => $oMaps
                        )
        );
    }

    /**
     * @Route("/tests/move")
     */
    public function testsMoveAction() {
        $moveDirection = $_GET['move'];

        $this->oMap = new Map(1);
        $unserFile = $this->oMap->load();
        $this->oMap = $unserFile;

        $this->oMap->move($moveDirection);

        return $this->render('GameBundle:Map:map.html.twig', array('map' => $this->oMap->getaElements()));
    }

}
