<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personage
 *
 * @ORM\Table(name="personage")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\PersonageRepository")
 */
class Personage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=1)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="PositionX", type="integer")
     */
    private $positionX;

    /**
     * @var int
     *
     * @ORM\Column(name="PositionY", type="integer")
     */
    private $positionY;

    /**
     * @var int
     *
     * @ORM\Column(name="HP", type="integer")
     */
    private $hP;

    /**
     * @var int
     *
     * @ORM\Column(name="Strength", type="integer")
     */
    private $strength;

    /**
     * @var int
     *
     * @ORM\Column(name="GameId", type="integer")
     */
    private $gameId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Personage
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set positionX
     *
     * @param integer $positionX
     *
     * @return Personage
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;

        return $this;
    }

    /**
     * Get positionX
     *
     * @return int
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * Set positionY
     *
     * @param integer $positionY
     *
     * @return Personage
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;

        return $this;
    }

    /**
     * Get positionY
     *
     * @return int
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * Set hP
     *
     * @param integer $hP
     *
     * @return Personage
     */
    public function setHP($hP)
    {
        $this->hP = $hP;

        return $this;
    }

    /**
     * Get hP
     *
     * @return int
     */
    public function getHP()
    {
        return $this->hP;
    }

    /**
     * Set strength
     *
     * @param integer $strength
     *
     * @return Personage
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     *
     * @return Personage
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }
}

