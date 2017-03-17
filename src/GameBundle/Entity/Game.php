<?php

namespace GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(name="gauntlet_game", repositoryClass="GameBundle\Repository\GameRepository")
 */
class Game
{
    /**
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="game" )
     */
    private $users;

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="nameRoom", type="string", length=100)
     */
    private $nameRoom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @var int
     *
     * @ORM\Column(name="nbPlayerMax", type="integer", nullable=false)
     */
    private $nbPlayerMax;

    /**
     * @var string
     *
     * @ORM\Column(name="saveGame", type="text", nullable=true)
     */
    private $saveGame;



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
     * Set status
     *
     * @param integer $status
     *
     * @return Game
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
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
     * Set nbPlayerMax
     *
     * @param integer $nbPlayerMax
     *
     * @return Game
     */
    public function setNbPlayerMax($nbPlayerMax)
    {
        $this->nbPlayerMax = $nbPlayerMax;

        return $this;
    }

    /**
     * Get nbPlayerMax
     *
     * @return int
     */
    public function getNbPlayerMax()
    {
        return $this->nbPlayerMax;
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
     * Add user
     *
     * @param \GameBundle\Entity\User $user
     *
     * @return Game
     */
    public function addUser(\GameBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \GameBundle\Entity\User $user
     */
    public function removeUser(\GameBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }
}
