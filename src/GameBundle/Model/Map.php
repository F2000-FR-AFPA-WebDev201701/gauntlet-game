<?php

namespace GameBundle\Model;

class Map {

    public static $_MOVE_UP      = 1;
    public static $_MOVE_RIGHT   = 2;
    public static $_MOVE_DOWN    = 3;
    public static $_MOVE_LEFT    = 4;

    // map
    public static $_MAP_MAX_X = 320;
    public static $_MAP_MAX_Y = 480;
    
    // element
    public static $_ELEMENT_OFFSET_MOVE   = 4;    // pixels
    public static $_ELEMENT_SIZE          = 32;   // pixels
   
    // elements
    protected $aElements = [];   

    /*
     * __construct()
     */
    function __construct() {

    }
    
    /*
     * create()
     * it's a map generator : create a new map in a file
     */
    public function create() {
        // load decor datas
        $this->decor1 = new Decor();
        $this->decor1->setPositionX(110);
        $this->decor1->setPositionY(110);
        $this->decor1->setType('mur'); // wall
        $this->decor1->setImage('wall.gif');
        /*
            $this->decor2 = new Decor();
            $this->decor2->setPositionX(123);
            $this->decor2->setPositionY(22);
            $this->decor2->setType('mur'); // wall
            $this->decor2->setImage('wall.gif');
        */
        $this->perso1 = new Personage();
        $this->perso1->setPositionX(210);
        $this->perso1->setPositionY(190);
        $this->perso1->setType('hero'); // perso

        $this->oMap = new Map();
        $this->oMap->addElement($this->perso1);
        $this->oMap->addElement($this->decor1);

        //$this->save($this->oMap);
    }

    /*
     * load()
     * load a map from a file
     */
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

    /*
     * save()
     * save a map (all elements + methods) into a file
     */
    public function save() {
        $ser = serialize($this);
        $fileNameSer = 'map1move';
        file_put_contents($fileNameSer, $ser);
    }
    
    /*
     * move()
     * move a element and save the map
     */
    public function move($moveDirection) {
        $elementA = $this->aElements[0];
        $elementB = $this->aElements[1];
        
        // move elementA (calcul)
        $this->calcMove($elementA, $moveDirection);
        
        // test if move is valid
        if ( ($this->checkCollisionMapside($elementA)) || ($this->checkCollision($elementA, $elementB)) ) {
            // collision with map side or and another element
            $this->calcMoveInverse($elementA, $moveDirection); // it's not a valid move then come back move
        } else {
            // no collisions then keep move and save the map
            $this->save();           
        }
    }   
    
    /*
     * calcMove($element, $moveDirection)
     * set element with new coord. Une a move direction.
     */
    private function calcMove($element, $moveDirection) {
        switch ($moveDirection) {
            case self::$_MOVE_UP :
                $element->setPositionY($element->getPositionY() - self::$_ELEMENT_OFFSET_MOVE);
            break;
            case self::$_MOVE_RIGHT :
                $element->setPositionX($element->getPositionX() + self::$_ELEMENT_OFFSET_MOVE);
                break;
            case self::$_MOVE_DOWN :
                $element->setPositionY($element->getPositionY() + self::$_ELEMENT_OFFSET_MOVE);
                break;
            case self::$_MOVE_LEFT :
                $element->setPositionX($element->getPositionX() - self::$_ELEMENT_OFFSET_MOVE);
                break;
        } // end switch
    }
    
    /*
     * calcMoveInverse($element, $moveDirection)
     * set element with new coord. Use a inverse move direction.
     */
    private function calcMoveInverse($element, $moveDirection) {
        switch ($moveDirection) {
            case self::$_MOVE_UP :
                $this->calcMove($element, self::$_MOVE_DOWN);
                break;
            case self::$_MOVE_RIGHT :
                $this->calcMove($element, self::$_MOVE_LEFT);
                break;
            case self::$_MOVE_DOWN :
                $this->calcMove($element, self::$_MOVE_UP);
                break;
            case self::$_MOVE_LEFT :
                $this->calcMove($element, self::$_MOVE_RIGHT);
                break;
        } // end switch
    }
    
    /*
     * checkCollisionMapside($elementA)
     * return true if a collision exist with border map
     **/ 
    private function checkCollisionMapside($element) {
        return (
                ($element->getPositionX() <= 0) || ($element->getPositionX() >= self::$_MAP_MAX_X) ||
                ($element->getPositionY() <= 0) || ($element->getPositionY() >= self::$_MAP_MAX_Y)
        );
    }    
    
    /*
     * checkCollision($element1, $element2)
     * return true if a collision exist with element2
     **/ 
    private function checkCollision($element1, $element2) {
        $x1 = $element1->getPositionX();
        $x2 = $element2->getPositionX();
        $y1 = $element1->getPositionY();
        $y2 = $element2->getPositionY();
        
        $maxLeft  = max($x1 , $x2);
        $maxRight = min($x1 + self::$_ELEMENT_SIZE , $x2 + self::$_ELEMENT_SIZE);
        $maxBottom   = max($y1 , $y2);
        $minTop  = min($y1 + self::$_ELEMENT_SIZE, $y2 + self::$_ELEMENT_SIZE);

        if( ($maxLeft < $maxRight) && ($maxBottom < $minTop) ) { // intersection
            return true;    // collision
        }
        // no collision
        return false;
    }
    
    /*
     * addElement($element)
     * add a element (wall, item, perso, ...) into $aElements
     * a element can be a array or a object (instance)
     */
    private function addElement($element) {
        $this->aElements[] = $element;
    }

    /**
     * Getters / Setters
     */
    public function getaElements() {
        return $this->aElements;
    }

    protected function setaElements($structure) {
        $this->aElements = $structure;
    }
}
