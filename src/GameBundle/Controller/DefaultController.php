<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
<<<<<<< HEAD

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('GameBundle:Default:index.html.twig');
    }
=======
use GameBundle\Entity\Decor;
use GameBundle\Entity\Personage;

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
        $decor1->setType('Mur'); // wall
        $decor1->setImage('wall.gif');

        $decor2 = new Decor();
        $decor2->setPositionX(72);
        $decor2->setPositionY(44);
        $decor2->setType('Mur'); // wall
        $decor2->setImage('wall.gif');

        // $perso1 = new Personage();

        $map = new Map();
        $map->addElement($decor1);
        $map->addElement($decor2);
        // $map->addItem($perso1);

        dump($decor1);
        dump($decor2);

        dump($oMap->getaElements());

        return $this->render('GameBundle:Default:tests.html.twig', $oMap->getaElements());
    }

>>>>>>> a2d36a22a51e1ad80a50cb3ba1e98b1f0b851338
}
