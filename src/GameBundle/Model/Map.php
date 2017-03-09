<?php

namespace GameBundle\Model;

class Map {

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

}
