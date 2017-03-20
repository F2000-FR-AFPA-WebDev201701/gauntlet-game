<?php

namespace GameBundle\Model;

class Map {

    public static $_MOVE_UP = 1;
    public static $_MOVE_RIGHT = 2;
    public static $_MOVE_DOWN = 3;
    public static $_MOVE_LEFT = 4;
    // map
    public static $_MAP_DIRECTORY = 'maps'; // /web/maps/
    public static $_MAP_FILENAME_EXT_INITIAL = '.initial'; //example map file /web/maps/1.initial
    public static $_MAP_MAX_X = 698;   // 698 pixels
    public static $_MAP_MAX_Y = 568;   // 568 pixels
    public static $_FIRST_MAP_TO_LOAD = 1; // map number to load when there's no saveGame  
    private $filenameMap = '';
    // element
    public static $_ELEMENT_OFFSET_MOVE = 4;  // pixels
    public static $_ELEMENT_SIZE = 64; // pixels
    // elements
    protected $aElements = [];

    /*
     * __construct()
     */
    function __construct() {

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
     * nbMaps()
     * return nbMaps (search in files)
     */
    public function nbMaps() {
        $nbMaps = $this->nbFilesInDirectory(self::$_MAP_DIRECTORY);
        return $nbMaps;
    }

    /*
     * load()
     * load a map from a file
     * return serialize map object
     */
    public function load($idMap = null) {
        if($idMap == null) {
            $idMap = self::$_FIRST_MAP_TO_LOAD;
        }
        
        if ($idMap > 0) {
            $this->initCurrentMapFilename($idMap);
        
            if (file_exists($this->filenameMap)) { // else test if initial map exist
                $filenameSer = $this->filenameMap;
            } else {
                return null;
            }
            $contentFile = file_get_contents($filenameSer);

            return($contentFile);
        }
        else {
            return null;
        }
    }

    /*
     * save()
     * save a map (all elements + methods) into a file
     * used to generate a new initial map
     */
    public function save($initial = true) {
        $ser = serialize($this);
        file_put_contents($this->filenameMap, $ser);
    }

    /*
     * delete()
     * delete all maps files
     */

    public function delete() {
        $this->deleteFilesDirectory(self::$_MAP_DIRECTORY);
    }

    /*
     * move()
     * move a element and save the map
     */
    public function move($moveDirection) {
        $elementA = $this->aElements[0]; // perso
        // move elementA (calcul)
        $this->calcMove($elementA, $moveDirection);

        // check collision between elementA and others elements
        $collision = false;
        for ($i = 1; $i < count($this->aElements); $i++) {
            // test if move is valid
            if (($this->checkCollisionMapside($elementA)) || ($this->checkCollision($elementA, $this->aElements[$i]))) {
                // collision with map side or and another element
                $collision = true;
            }
        }

        // not move if collision
        if ($collision) {
            $this->calcMoveInverse($elementA, $moveDirection); // it's not a valid move then come back move
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
     * init filenameMap = filename of specific map
     * */
    private function initCurrentMapFilename($idMap) {
        $this->filenameMap = self::$_MAP_DIRECTORY . '/' . $idMap . self::$_MAP_FILENAME_EXT_INITIAL;
    }

    /*
     * deleteFilesDirectory($directory)
     * delete all files in a directory
     * */
    private function deleteFilesDirectory($directory) {
        // open dir
        $directoryOpen = opendir($directory);

        // read all files one
        while (false !== ($filename = readdir($directoryOpen))) {
            $fullFilename = $directory . "/" . $filename;
            if ($filename != "." AND $filename != ".." AND ! is_dir($filename)) {
                unlink($fullFilename);
            }
        }

        closedir($directoryOpen); // On ferme !
    }

    /*
     * nbFilesInDirectory($directory)
     * return nb files in a directory
     * */
    private function nbFilesInDirectory($directory) {
        $nbFiles = 0;
        // open dir
        $directoryOpen = opendir($directory);

        // read all files name one by one
        while (false !== ($filename = readdir($directoryOpen))) {
            $fullFilename = $directory . "/" . $filename;
            if ($filename != "." AND $filename != ".." AND ! is_dir($filename)) {
                $nbFiles++;
            }
        }
        closedir($directoryOpen); // close

        return $nbFiles;
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
