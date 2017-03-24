<?php

namespace GameBundle\Model;

/**
 * Personage
 */
class Personage {

    private static $_DEFAULT_TYPE = "hero";
    private static $_DEFAULT_HP = 500;
    private static $_DEFAULT_SCORE = 0;
    private static $_DEFAULT_STRENGTH = 50;

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
    private $maxHp;

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
     * @var int
     */
    private $clef;

    /**
     * Constructor
     */
    public function __construct() {
        $this->clef = false;
        $this->type = self::$_DEFAULT_TYPE;
        $this->hp = self::$_DEFAULT_HP;
        $this->maxHp = $this->hp;
        $this->score = self::$_DEFAULT_SCORE;
        $this->strength = self::$_DEFAULT_STRENGTH;
    }

    /**
     * receiveHit($strength)
     */
    public function receiveHit($strength = 50) {
        $this->hp -= $strength;
        if ($this->hp < 0) {
            $this->hp = 0;
        } else {
            $this->setTypeHp();
        }
    }

    /**
     * receiveHp($hp)
     */
    public function receiveHp($hp = 50) {
        $this->hp += $hp;
        if ($this->hp > $this->maxHp) {
            $this->hp = $this->maxHp;
        }
        $this->setTypeHp();
    }

    /**
     *  receivePoints($points)
     */
    public function receivePoints($points = 100) {
        $this->score += $points;
    }

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
     * Set typeHp
     *
     * @param no parameter
     *
     * @return Monster
     */
    public function setTypeHp() {
        $ratioHpFullLife = $this->hp / $this->maxHp;

        if ($ratioHpFullLife < 1 && $ratioHpFullLife >= 0.66) {
            $this->typeHp = '66';
            return $this;
        }

        if ($ratioHpFullLife < 0.66 && $ratioHpFullLife >= 0.33) {
            $this->typeHp = '33';
            return $this;
        }

        if ($ratioHpFullLife < 0.33 && $ratioHpFullLife > 0) {
            $this->typeHp = '00';
            return $this;
        }

        return $this;
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
        $this->maxHp = $hp;

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
     * Set maxHp
     *
     * @param integer $maxHp
     *
     * @return Personage
     */
    public function setMaxHp($maxHp) {
        $this->maxHp = $maxHp;

        return $this;
    }

    /**
     * Get maxHp
     *
     * @return int
     */
    public function getMaxHp() {
        return $this->maxHp;
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

    /**
     * @return boolean
     */
    public function getClef() {
        return $this->clef;
    }

    /**
     * @param boolean $clef
     */
    public function setClef($clef) {
        $this->clef = $clef;
    }

}
