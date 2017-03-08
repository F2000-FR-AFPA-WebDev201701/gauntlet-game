<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapElement
 *
 * @ORM\Table(name="map_element")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\MapElementRepository")
 */
class MapElement
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
     * @ORM\Column(name="TypeClass", type="string", length=128)
     */
    private $typeClass;

    /**
     * @var int
     *
     * @ORM\Column(name="TypeClassId", type="integer")
     */
    private $typeClassId;


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
     * Set typeClass
     *
     * @param string $typeClass
     *
     * @return MapElement
     */
    public function setTypeClass($typeClass)
    {
        $this->typeClass = $typeClass;

        return $this;
    }

    /**
     * Get typeClass
     *
     * @return string
     */
    public function getTypeClass()
    {
        return $this->typeClass;
    }

    /**
     * Set typeClassId
     *
     * @param integer $typeClassId
     *
     * @return MapElement
     */
    public function setTypeClassId($typeClassId)
    {
        $this->typeClassId = $typeClassId;

        return $this;
    }

    /**
     * Get typeClassId
     *
     * @return int
     */
    public function getTypeClassId()
    {
        return $this->typeClassId;
    }
}

