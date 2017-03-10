<?php

namespace GameBundle\Model;

class Map {

    public static $_MOVEUP = 1;
    public static $_MOVERIGHT = 2;
    public static $_MOVEDOWN = 3;
    public static $_MOVELEFT = 4;
    public static $_OFFSETMOVE = 4; //pixels
    //private $moveDirection;
    private $mapMaxX = 320;
    private $mapMaxY = 480;
    protected $aElements = [];

    /*
     * addElement($element)
     * add a element (wall, item, perso, ...) into $aElements
     * a element can be a array or a object (instance)
     */

    function addElement($element) {
        $this->aElements[] = $element;
    }

    function __construct() {

    }

    public function getaElements() {
        return $this->aElements;
    }

    protected function setaElements($structure) {
        $this->aElements = $structure;
    }

    private function createAction() { // create a new map in a file
        // load decor datas
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(110);
        $this->decor1->setPositionY(110);
        $this->decor1->setType('mur'); // wall
        $this->decor1->setImage('wall.gif');
        /*
                $decor2 = new Decor();
                $decor2->setPositionX(123);
                $decor2->setPositionY(22);
                $decor2->setType('mur'); // wall
                $decor2->setImage('wall.gif');
        */
        $this->perso1 = new Personage();
        $this->perso1->setPositionX(210);
        $this->perso1->setPositionY(190);
        $this->perso1->setType('hero'); // perso

        $this->oMap = new Map();
        $this->oMap->addElement($this->perso1);

        $this->oMap->addElement($this->decor1);

        //dump($decor1);
        //dump($decor2);

        //dump($oMap->getaElements());
        //$this->save(new);
    }


    public function load() {
        if(file_exists('map1move')) {
            $filenameSer = 'map1move';
        } else if(file_exists('map1')) {
            $filenameSer = 'map1';
        }
        else {
            // create map1
        }
        $contentFile = file_get_contents($filenameSer);
        $unserFile = unserialize($contentFile);

        return($unserFile);
    }

    public function save() {
        $ser = serialize($this);
        $fileNameSer = 'map1move';
        file_put_contents($fileNameSer, $ser);
    }

    public function collision($moveDirection){
        dump('debut collision test');
        //Comparaison Y1/Y2 & X1/X2
        $x1 = $this->aElements[0]->getPositionX();
        $y1 = $this->aElements[0]->getPositionY();
        $x2 = $this->aElements[1]->getPositionX();
        $y2 = $this->aElements[1]->getPositionY();
        /*
        A1(x1,      y1)       <   C2(x2+32,   y2+32)
        B1(x1+32,   y1)       <   D2(x2,      y2+32)
        C1(x1+32,   y1+32)    <   A2(x2,      y2)
        D1(x1,      y1+32)    <   B2(x2+32,   y2)   //pour x et pour y
        */
        if ($moveDirection == self::$_MOVELEFT || $moveDirection == self::$_MOVEUP) {
            if ((($x1 >= $x2) && ($x1 <= ($x2 + 32))) && (($y1 >= $y2) && ($y1 <= ($y2 + 32)))) {
                dump('collision entre A1 et C2!');
                return false;
            }
        }

        if ($moveDirection == self::$_MOVERIGHT || $moveDirection == self::$_MOVEUP) {
            if (((($x1 + 32) >= $x2) && (($x1 + 32) <= $x2 + 32)) && (($y1 >= $y2) && ($y1 <= ($y2 + 32)))) {
                dump('collision entre B1 et D2!');

                return false;
            }
        }

        if ($moveDirection == self::$_MOVERIGHT || $moveDirection == self::$_MOVEDOWN) {
            if ((($x1 + 32 >= $x2) && (($x1 + 32) <= ($x2 + 32))) && ((($y1 + 32) <= ($y2 + 32)) && (($y1 + 32) >= $y2))) {
                dump('collision entre C1 et A2!');

                return false;
            }
        }
        if ($moveDirection == self::$_MOVELEFT || $moveDirection ==  self::$_MOVEDOWN) {
            if ((($x1 <= $x2 + 32) && ($x1 >= $x2)) && ((($y1 + 32) >= $y2) && (($y1 + 32) <= ($y2 + 32)))) {
                dump('collision entre D1 et B2!');

                return false;
            }
        }
        dump('no collision');
        return true;


    }

    public function move($moveDirection) {
        //dump($moveDirection);
        if ($this->moveable($moveDirection)) {
            switch ($moveDirection) {
                case self::$_MOVEUP :
                    $this->aElements[0]->setPositionY($this->aElements[0]->getPositionY() - self::$_OFFSETMOVE);
                    break;
                case self::$_MOVERIGHT :
                    $this->aElements[0]->setPositionX($this->aElements[0]->getPositionX() + self::$_OFFSETMOVE);
                    break;
                case self::$_MOVEDOWN :
                    $this->aElements[0]->setPositionY($this->aElements[0]->getPositionY() + self::$_OFFSETMOVE);
                    break;
                case self::$_MOVELEFT :
                    $this->aElements[0]->setPositionX($this->aElements[0]->getPositionX() - self::$_OFFSETMOVE);
                    break;
            } // end switch
            //save
            $this->save();
        }
    }

    public function moveable($moveDirection) {
        //return true;
        switch ($moveDirection) {
            case self::$_MOVEUP :
                $condition = ($this->aElements[0]->getPositionY() - self::$_OFFSETMOVE >= 0);
                if (!$condition) {
                    //  $this->posPersoY = $this->mapMaxY - 2;
                }
                break;
            case self::$_MOVERIGHT :
                $condition = ($this->aElements[0]->getPositionX() + self::$_OFFSETMOVE <= $this->mapMaxX);
                if (!$condition) {
                    // $this->posPersoX = $this->mapMaxX - 2;
                }
                break;
            case self::$_MOVEDOWN :
                $condition = ($this->aElements[0]->getPositionY() + 32 + self::$_OFFSETMOVE <= $this->mapMaxY);
                if (!$condition) {
                    // $this->posPersoX = $this->mapMaxY + 2;
                }
                break;
            case self::$_MOVELEFT :
                $condition = ($this->aElements[0]->getPositionX() - self::$_OFFSETMOVE >= 0);
                if (!$condition) {
                    // $this->posPersoX = $this->mapMaxX + 2;
                }
                break;
        } // end switch

            return ($condition && ($this->collision($moveDirection)));
    }




}
