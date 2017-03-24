<?php

namespace GameBundle\Model;

/**
 * Decor
 */
class Decor {

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $positionX;

    /**
     * @var int
     */
    private $positionY;

    /**
     * @var string
     */
    private $type;
    
    /**
     * @var int
     */
    private $subType;   

    /**
     * @var string
     */
    private $image;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->subType = '';
    }

    /**
     * Get id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set positionX
     *
     * @param integer $positionX
     *
     * @return Decor
     */
    public function setPositionX($positionX) {
        $this->positionX = $positionX;

        return $this;
    }

    /**
     * Get positionX
     *
     * @return int
     */
    public function getPositionX() {
        return $this->positionX;
    }

    /**
     * Set positionY
     *
     * @param integer $positionY
     *
     * @return Decor
     */
    public function setPositionY($positionY) {
        $this->positionY = $positionY;

        return $this;
    }

    /**
     * Get positionY
     *
     * @return int
     */
    public function getPositionY() {
        return $this->positionY;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Decor
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Get getsubType
     *
     * @return string
     */
    public function getsubType() {
        return $this->subType;
    }        

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Decor
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

}
