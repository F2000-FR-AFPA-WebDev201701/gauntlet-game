<?php

namespace GameBundle\Model;

/**
 * Decor
 */
class Item {

    private static $_DEFAULT_BONUS = 100;

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
    private $bonus;

    /**
     * @var string
     */
    private $image;

    /**
     * constructor
     */
    function __construct() {
        $this->bonus = self::$_DEFAULT_BONUS;
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
     * Set type
     *
     * @param int $bonus
     *
     * @return Decor
     */
    public function setBonus($bonus) {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bonus
     *
     * @return Decor
     */
    public function getBonus() {
        return $this->bonus;
    }

    /**
     * Set image
     *
     * @param int $value
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
