<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\City;
use AppBundle\Entity\Cityconfig;

class CityManager {
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function createCity($requestData) {
        $city = new City();
        $cityconfig = $this->em->getRepository('AppBundle:Cityconfig')->find($requestData['config_id']);

        $city->setCityconfig($cityconfig);
        $city->setName($requestData['name']);
        $city->setStartDate(new \Datetime($requestData['start_date']));
        $city->setEndDate(new \Datetime($requestData['end_date']));
        $this->em->persist($cityconfig);
        $this->em->persist($city);
        $this->em->flush();
    }
}