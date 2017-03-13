<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Model\Decor;
use GameBundle\Model\Personage;
use GameBundle\Model\Map;
use Symfony\Component\BrowserKit\Request;

class DefaultController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        return $this->render('GameBundle:Default:index.html.twig');
    }

    /**
     * @Route("/sitemap")
     */
    public function siteMapAction() {
        return $this->render('GameBundle:Default:sitemap.html.twig');
    }

    /**
     * @Route("/tests")
     */
    public function testsAction() {
        $this->oMap = new Map(2);
        $unserFile = $this->oMap->load();
        $this->oMap = $unserFile;

        return $this->render('GameBundle:Map:template.html.twig', array('map' => $this->oMap->getaElements()));
    }

    /**
     * @Route("/tests/move")
     */
    public function testsMoveAction() {
        $moveDirection = $_GET['move'];

        $this->oMap = new Map(2);
        $unserFile = $this->oMap->load();
        $this->oMap = $unserFile;

        $this->oMap->move($moveDirection);

        return $this->render('GameBundle:Map:initmap.html.twig', array('map' => $this->oMap->getaElements()));
    }

}
