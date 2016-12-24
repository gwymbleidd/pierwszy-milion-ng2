<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Accessor;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 */
class City
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
     *
     * @ORM\ManyToOne(targetEntity="Cityconfig", inversedBy="id")
     * @ORM\JoinTable(name="cityconfig",
     * joinColumns={@ORM\JoinColumn(name="cityconfig_id", referencedColumnName="id")},
     * )
     * @Groups({"cityList"})
     */
    private $cityconfig;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Groups({"cityList"})
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetimetz")
     * @Groups({"cityList"})
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetimetz")
     * @Groups({"cityList"})
     */
    private $endDate;


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
     * Set config
     *
     * @param \AppBundle\Entity\Cityconfig $cityconfig
     *
     * @return City
     */
    public function setCityconfig(\AppBundle\Entity\Cityconfig $cityconfig = null)
    {
        $this->cityconfig = $cityconfig;

        return $this;
    }

    /**
     * Get cityconfig
     *
     * @return \AppBundle\Entity\Cityconfig
     */
    public function getCityconfig()
    {
        return $this->cityconfig;
        ;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return City
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return City
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
