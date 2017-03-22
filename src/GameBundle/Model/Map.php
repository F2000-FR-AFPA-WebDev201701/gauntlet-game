<?php

namespace GameBundle\Model;

use GameBundle\Model\Tool;

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
    protected $nextLvl = false;
    protected $currentLvl = 0;

    // element
    public static $_ELEMENT_OFFSET_MOVE = 4;  // pixels
    public static $_ELEMENT_SIZE = 64; // pixels
    // elements
    protected $aElements = []; // all elements : used by view
    protected $aElementsCharacters = [];
    protected $aElementsDecors = [];
    protected $aElementsItems = [];
    protected $aElementsMonsters = [];


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

    public function addElementCharacter($element) {
        $this->aElementsCharacters[] = $element;
    }

    public function addElementDecor($element) {
        $this->aElementsDecors[] = $element;
    }

    public function addElementItem($element) {
        $this->aElementsItems[] = $element;
    }

    public function addElementMonster($element) {
        $this->aElementsMonsters[] = $element;
    }

    /*
     * nbMaps()
     * return nbMaps (search in files)
     */

    public function nbMaps() {
        $tool = new Tool();
        $nbMaps = $tool->nbFilesInDirectory(self::$_MAP_DIRECTORY);
        return $nbMaps;
    }

    /*
     * load()
     * load a map from a file
     * return serialize map object
     */

    public function load($idMap = null) {
        if ($idMap == null) {
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
        } else {
            return null;
        }
    }

    /*
     * save()
     * save a map (all elements + methods) into a file
     * used to generate a new initial map
     */

    public function save($idMap = null) {
        if ($idMap > 0) {
            $this->currentLvl = $idMap;
            $this->initCurrentMapFilename($idMap);
            $ser = serialize($this);
            file_put_contents($this->filenameMap, $ser);
        } else {
            return null;
        }
    }

    /*
     * delete()
     * delete all maps files
     */

    public function delete() {
        $tool = new Tool();
        $tool->deleteFilesDirectory(self::$_MAP_DIRECTORY);
    }

    /*
     * move()
     * move a element and save the map
     */

    public function move($moveDirection) {
        if (isset($this->aElementsCharacters[0])) {
            $elementCharacter = $this->aElementsCharacters[0]; // perso 1
        } else {
            return false;
        }

        $nbMonsters = count($this->aElementsMonsters);
        for ($i = 0; $i < $nbMonsters; $i++) {
            $this->moveMonster($this->aElementsMonsters[$i], $i, $elementCharacter);
        }

        // move elementA (calcul)
        $this->calcMove($elementCharacter, $moveDirection);

        $collision = false;

        // check collision with map sides
        if ($this->checkCollisionMapside($elementCharacter)) {
            $collision = true;
        } else {
            // check collision between elementA and all decors
            $collision = $this->checkCollisionsWithElements($elementCharacter, $this->aElementsDecors);
            if ($collision == false) {
                $collision = $this->checkCollisionsWithElements($elementCharacter, $this->aElementsMonsters);
            }
        }

        // not move if collision
        if ($collision) {
            $this->calcMoveInverse($elementCharacter, $moveDirection); // it's not a valid move then come back move
        } else {
            // check collision between elementA (perso) and all items (key, exit (door), ...)
            $nbItems = count($this->aElementsItems);
            $eraseItem = false;
            for ($i = 0; $i < $nbItems; $i++) {
                // test if move is valid
                if ($this->checkCollision($elementCharacter, $this->aElementsItems[$i])) {
                    // collision with a item
                    switch ($this->aElementsItems[$i]->getType()) {
                        case 'potion' :
                            $elementCharacter->receiveHp($this->aElementsItems[$i]->getBonus());
                            break;
                        case 'clef' :
                            $elementCharacter->setClef(true);
                            break;
                        case 'nextlvl' :
                            if($elementCharacter->getClef()) {
                                $this->setNextlvl(true);
                                $eraseItem = true;
                                unset($this->aElementsItems[$i]);
                            } else
                            {
                                $this->calcMoveInverse($elementCharacter, $moveDirection);
                            }
                            break;
                    } // end switch
                } // end if collision
            } // end for items
            if ($eraseItem) {
                $this->aElementsItems = array_values($this->aElementsItems);
            }
        }
    }

    /*
     * moveMonster()
     * move a monster
     */

    public function moveMonster($monster, $monsterId, $character) {
        $_UL = [self::$_MOVE_UP, self::$_MOVE_LEFT];
        $_UR = [self::$_MOVE_UP, self::$_MOVE_RIGHT];
        $_DL = [self::$_MOVE_DOWN, self::$_MOVE_LEFT];
        $_DR = [self::$_MOVE_DOWN, self::$_MOVE_RIGHT];

        $randomKey = array_rand(array(0, 1));

        if (($monster->getPositionX() > $character->getPositionX()) &&
                ($monster->getPositionY() > $character->getPositionY())
        ) {
            $this->doMonsterMove($monster, $monsterId, $character, $_UL[$randomKey]);
        }

        if (($monster->getPositionX() < $character->getPositionX()) &&
                ($monster->getPositionY() > $character->getPositionY())
        ) {
            $this->doMonsterMove($monster, $monsterId, $character, $_UR[$randomKey]);
        }

        if (($monster->getPositionX() > $character->getPositionX()) &&
                ($monster->getPositionY() < $character->getPositionY())
        ) {
            $this->doMonsterMove($monster, $monsterId, $character, $_DL[$randomKey]);
        }

        if (($monster->getPositionX() < $character->getPositionX()) &&
                ($monster->getPositionY() < $character->getPositionY())
        ) {
            $this->doMonsterMove($monster, $monsterId, $character, $_DR[$randomKey]);
        }
    }

    /*
     * attack()
     * attack a monster
     */
    public function attack() {
        // checker la collision avec les monstres //récupérer l'ID des monstres

        for ($i = 0; $i < count($this->aElementsMonsters); $i++) {
            // test if move is valid

            if ($this->checkCollisionAttack($this->aElementsCharacters[0], $this->aElementsMonsters[$i])) {
                $this->aElementsMonsters[$i]->receiveHit($this->aElementsCharacters[0]->getStrength());
            }
        }
        foreach ($this->aElementsMonsters as $key => $oMonster) {
            if ($oMonster->getHp() <= 0) {
                unset($this->aElementsMonsters[$key]);
            }
        }
        $this->aElementsMonsters = array_values($this->aElementsMonsters);
    }

    /*
     * checkCollisionMonsterWithCharacter
     *
     */

    private function doMonsterMove($monster, $monsterId, $character, $move) {
        // monsters collisions with decors & items & monsters
        $this->calcMove($monster, $move);
        if ($this->checkCollisionsWithElements($monster, $this->aElementsDecors) ||
                $this->checkCollisionsWithElements($monster, $this->aElementsItems) ||
                $this->checkCollisionsWithElementsWithoutId($monster, $this->aElementsMonsters, $monsterId)) {
            $this->calcMoveInverse($monster, $move);
        } else { // monsters collisions with characters
            if ($this->checkCollision($monster, $character)) {
                $character->receiveHit($monster->getStrength());
                $this->calcMoveInverse($monster, $move);
            }
        }
    }

    // check collision between element and all elements defined in aElements
    private function checkCollisionsWithElements($element, $aElements) {
        $nbItems = count($aElements);
        for ($i = 0; $i < $nbItems; $i++) {
            // test if move is valid
            if ($this->checkCollision($element, $aElements[$i])) {
                // collision with map side or and another element
                return true;
            }
        }
        return false;
    }

    // check collision between elementA and all elements defined in aElements without aElements[$id]
    private function checkCollisionsWithElementsWithoutId($element, $aElements, $id) {
        $nbItems = count($aElements);
        for ($i = 0; $i < $nbItems; $i++) {
            if ($i != $id) {
                // test if move is valid
                if ($this->checkCollision($element, $aElements[$i])) {
                    // collision with map side or and another element
                    return true;
                }
            }
        }
        return false;
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

    private function checkCollisionAttack($element1, $element2) {
        $x1 = $element1->getPositionX();
        $x2 = $element2->getPositionX();
        $y1 = $element1->getPositionY();
        $y2 = $element2->getPositionY();

        $maxLeft = max($x1, $x2);
        $minRight = min($x1 + 80, $x2 + 80);
        $maxBottom = max($y1, $y2);
        $minTop = min($y1 + 80, $y2 + 80);

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

    /**
     * Getters / Setters
     */
    public function getaElements() {
        $this->aElements = array_merge(
                $this->getaElementsCharacters(), $this->getaElementsDecors(), $this->getaElementsItems(), $this->getaElementsMonsters()
        );
        return $this->aElements;
    }

    public function getaElementsCharacters() {
        return $this->aElementsCharacters;
    }

    public function setaElementsCharacters($structure) {
        $this->aElementsCharacters = $structure;
    }

    public function getaElementsDecors() {
        return $this->aElementsDecors;
    }

    public function setaElementsDecors($structure) {
        $this->aElementsDecors = $structure;
    }

    public function getaElementsItems() {
        return $this->aElementsItems;
    }

    public function setaElementsItems($structure) {
        $this->aElementsItems = $structure;
    }

    public function getaElementsMonsters() {
        return $this->aElementsMonsters;
    }

    public function setaElementsMonsters($structure) {
        $this->aElementsMonsters = $structure;
    }
    
    /**
     * @return int
     */
    public function getCurrentLvl()
    {
        return $this->currentLvl;
    }

    /**
     * @param int $currentLvl
     */
    public function setCurrentLvl($currentLvl)
    {
        $this->currentLvl = $currentLvl;
    }    
    

    /**
     * @return bool
     */
    public function isNextlvl()
    {
        return $this->nextLvl;
    }

    /**
     * @param bool $nextlvl
     */
    public function setNextlvl($nextLvl)
    {
        $this->nextLvl = $nextLvl;
    }

    
}
