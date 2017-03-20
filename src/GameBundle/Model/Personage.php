<?php

namespace GameBundle\Model;

/**
 * Personage
 */
class Personage {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $positionX;

    /**
     * @var int
     */
    private $positionY;

    /**
     * @var int
     */
    private $hp;

    /**
     * @var int
     */
    private $score;

    /**
     * @var int
     */
    private $strength;

    /**
     * @var int
     */
    private $gameId;

    /**
     * Get id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Personage
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
     * Set positionX
     *
     * @param integer $positionX
     *
     * @return Personage
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
     * @return Personage
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
     * Set hp
     *
     * @param integer $hp
     *
     * @return Personage
     */
    public function setHp($hp) {
        $this->hp = $hp;

        return $this;
    }

    /**
     * Get hp
     *
     * @return int
     */
    public function getHp() {
        return $this->hp;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Personage
     */
    public function setScore($score) {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * Set strength
     *
     * @param integer $strength
     *
     * @return Personage
     */
    public function setStrength($strength) {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return int
     */
    public function getStrength() {
        return $this->strength;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     *
     * @return Personage
     */
    public function setGameId($gameId) {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return int
     */
    public function getGameId() {
        return $this->gameId;
    }

}
