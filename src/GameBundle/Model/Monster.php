<?php

namespace GameBundle\Model;

/**
 * Monster
 */
class Monster {

    private static $_DEFAULT_TYPE = "ghost";
    private static $_DEFAULT_HP = 250;
    private static $_DEFAULT_STRENGTH = 10;
    private static $_DEFAULT_BONUS = 25;

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
    private $strength;

    /**
     * @var bonus
     */
    private $bonus;

    /**
     * Constructor
     */
    public function __construct() {
        $this->type = self::$_DEFAULT_TYPE;
        $this->hp = self::$_DEFAULT_HP;
        $this->maxHp = $this->hp;
        $this->strength = self::$_DEFAULT_STRENGTH;
        $this->bonus = self::$_DEFAULT_BONUS;
    }

    public function receiveHit($strength = 50) {
        $this->hp -= $strength;
        if ($this->hp < 0) {
            $this->hp = 0;
        } else {
            $this->setTypeHp();
        }
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
     * @return Monster
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
     * @return Monster
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
     * @return Monster
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
     * @return Monster
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
     * Set strength
     *
     * @param integer $strength
     *
     * @return Monster
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

}
