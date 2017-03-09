<?php

namespace GameBundle\Entity;

class Map {

    protected $aElements = [];

    function addElement($element) {
        //function qui remplit le tableau d'objets de types decors/persos/items
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
