<?php

namespace GameBundle\Model;

class Map {

    public static $_MOVE_UP = 1;
    public static $_MOVE_RIGHT = 2;
    public static $_MOVE_DOWN = 3;
    public static $_MOVE_LEFT = 4;
    // map
    public static $_MAP_DIRECTORY = 'maps'; // /web/maps
    public static $_MAP_MAX_X = 320;   // 320 pixels
    public static $_MAP_MAX_Y = 480;   // 480 pixels
    private $filenameMap = '';
    private $filenameMapGame = '';
    // element
    public static $_ELEMENT_OFFSET_MOVE = 4;  // pixels
    public static $_ELEMENT_SIZE = 32; // pixels
    // elements
    protected $aElements = [];

    /*
     * __construct()
     */

    function __construct($idMap = 1) {
        $this->initCurrentMapFilename($idMap);
    }

    /*
     * addElement($element)
     * add a element (wall, item, perso, ...) into $aElements
     * a element can be a array or a object (instance)
     */

    public function addElement($element) {
        $this->aElements[] = $element;
    }

    /*
     * load()
     * load a map from a file
     */

    public function load() {
        if (file_exists($this->filenameMapGame)) { // test if game exist
            $filenameSer = $this->filenameMapGame;
        } else if (file_exists($this->filenameMap)) { // else test if initial map exist
            $filenameSer = $this->filenameMap;
        } else {
            return null;
        }
        $contentFile = file_get_contents($filenameSer);
        $unserFile = unserialize($contentFile);

        return($unserFile);
    }

    /*
     * save()
     * save a map (all elements + methods) into a file
     */

    public function save($initial = true) {
        $ser = serialize($this);
        $filenameSer = ($initial) ? $this->filenameMap : $this->filenameMapGame;
        file_put_contents($filenameSer, $ser);
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
        if (($this->checkCollisionMapside($elementA)) || ($this->checkCollision($elementA, $elementB))) {
            // collision with map side or and another element
            $this->calcMoveInverse($elementA, $moveDirection); // it's not a valid move then come back move
        } else {
            // no collisions then keep move and save the map
            $this->save(false);
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
     * */

    private function checkCollisionMapside($element) {
        return (
                ($element->getPositionX() <= 0) || ($element->getPositionX() >= self::$_MAP_MAX_X) ||
                ($element->getPositionY() <= 0) || ($element->getPositionY() >= self::$_MAP_MAX_Y)
                );
    }

    /*
     * checkCollision($element1, $element2)
     * return true if a collision exist with element2
     * */

    private function checkCollision($element1, $element2) {
        $x1 = $element1->getPositionX();
        $x2 = $element2->getPositionX();
        $y1 = $element1->getPositionY();
        $y2 = $element2->getPositionY();

        $maxLeft = max($x1, $x2);
        $minRight = min($x1 + self::$_ELEMENT_SIZE, $x2 + self::$_ELEMENT_SIZE);
        $maxBottom = max($y1, $y2);
        $minTop = min($y1 + self::$_ELEMENT_SIZE, $y2 + self::$_ELEMENT_SIZE);

        if (($maxLeft < $minRight) && ($maxBottom < $minTop)) { // intersection
            return true; // collision
        }
        // no collision
        return false;
    }

    /*
     * initCurrentMapFilename($idMap)
     * init filenameMap & filenameMapGame = filename of specific map
     * */

    private function initCurrentMapFilename($idMap) {
        $this->filenameMap = self::$_MAP_DIRECTORY . '/map' . $idMap;
        $this->filenameMapGame = $this->filenameMap . 'move';
    }

    /**
     * Getters / Setters
     */
    public function getaElements() {
        return $this->aElements;
    }

    public function setaElements($structure) {
        $this->aElements = $structure;
    }

}
