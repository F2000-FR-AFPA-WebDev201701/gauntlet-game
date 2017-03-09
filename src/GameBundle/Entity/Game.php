<?php

namespace GameBundle\Entity;

class Game {

    protected $id;
    protected $nameRoom;
    protected $score;
    protected $date;
    protected $nbPlayer;
    protected $saveGame;
    protected $idUser;

    /**
     * @var integer
     */
    private $Score;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameRoom
     *
     * @param string $nameRoom
     *
     * @return Game
     */
    public function setNameRoom($nameRoom)
    {
        $this->nameRoom = $nameRoom;

        return $this;
    }

    /**
     * Get nameRoom
     *
     * @return string
     */
    public function getNameRoom()
    {
        return $this->nameRoom;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Game
     */
    public function setScore($score)
    {
        $this->Score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->Score;
    }

    /**
     * Set nbPlayer
     *
     * @param integer $nbPlayer
     *
     * @return Game
     */
    public function setNbPlayer($nbPlayer)
    {
        $this->nbPlayer = $nbPlayer;

        return $this;
    }

    /**
     * Get nbPlayer
     *
     * @return integer
     */
    public function getNbPlayer()
    {
        return $this->nbPlayer;
    }

    /**
     * Set saveGame
     *
     * @param string $saveGame
     *
     * @return Game
     */
    public function setSaveGame($saveGame)
    {
        $this->saveGame = $saveGame;

        return $this;
    }

    /**
     * Get saveGame
     *
     * @return string
     */
    public function getSaveGame()
    {
        return $this->saveGame;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Game
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Game
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
