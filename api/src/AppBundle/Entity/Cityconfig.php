<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Accessor;

/**
 * Cityconfig
 *
 * @ORM\Table(name="Cityconfig")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityconfigRepository")
 */
class Cityconfig
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"cityList"})
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="users_limit", type="integer")
     */
    private $usersLimit;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     * @Groups({"cityList"})
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     * @Groups({"cityList"})
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="starting_map_area", type="integer")
     * @Groups({"cityList"})
     */
    private $startingMapArea;

    /**
     * @var int
     *
     * @ORM\Column(name="field_start_price", type="integer")
     * @Groups({"cityList"})
     */
    private $fieldStartPrice;


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
     * Set usersLimit
     *
     * @param integer $usersLimit
     * @return Cityconfig
     */
    public function setUsersLimit($usersLimit)
    {
        $this->usersLimit = $usersLimit;

        return $this;
    }

    /**
     * Get usersLimit
     *
     * @return integer 
     */
    public function getUsersLimit()
    {
        return $this->usersLimit;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Cityconfig
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Cityconfig
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set startingMapArea
     *
     * @param integer $startingMapArea
     * @return Cityconfig
     */
    public function setStartingMapArea($startingMapArea)
    {
        $this->startingMapArea = $startingMapArea;

        return $this;
    }

    /**
     * Get startingMapArea
     *
     * @return integer 
     */
    public function getStartingMapArea()
    {
        return $this->startingMapArea;
    }

    /**
     * Set fieldStartPrice
     *
     * @param integer $fieldStartPrice
     * @return Cityconfig
     */
    public function setFieldStartPrice($fieldStartPrice)
    {
        $this->fieldStartPrice = $fieldStartPrice;

        return $this;
    }

    /**
     * Get fieldStartPrice
     *
     * @return integer 
     */
    public function getFieldStartPrice()
    {
        return $this->fieldStartPrice;
    }
}
