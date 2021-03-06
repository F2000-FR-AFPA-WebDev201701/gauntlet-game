<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="gauntlet_user")
 * @ORM\Entity
 */
class User implements UserInterface {

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(name="pseudo", type="string", length=15, unique=true)
     */
    protected $pseudo;

    /**
     *
     * @ORM\Column(name="confirmPassword", type="string", length=255)
     */
    protected $confirmPassword;

    /**
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     *
     * @ORM\Column(name="email", type="string", length=50, unique=true)
     */
    protected $email;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="users")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $game;
    protected $salt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return User
     *
     *
     *
     *
     */
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo() {
        return $this->pseudo;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get confirmPassword
     *
     * @return string
     */
    public function getConfirmPassword() {
        return $this->confirmPassword;
    }

    /**
     * Set confirmPassword
     *
     * @param string confirmPassword
     *
     * @return string
     */
    public function setConfirmPassword($password) {
        $this->confirmPassword = $password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function eraseCredentials() {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    /**
     * Set game
     *
     * @param \GameBundle\Entity\Game $game
     *
     * @return User
     */
    public function setGame(\GameBundle\Entity\Game $game = null) {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \GameBundle\Entity\Game
     */
    public function getGame() {
        return $this->game;
    }

}
