<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Building;

class BuildingManager {
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function createBuilding($requestData) {
        $building = new Building();

        $building->setName($requestData['name']);
        $building->setWidth($requestData['width']);
        $building->setHeight($requestData['height']);
        $building->setPrice($requestData['price']);
        $this->em->persist($building);
        $this->em->flush();
        return $building->getId();
    }

    public function updateBuilding($requestData, $id) {
        $building = $this->em->getRepository('AppBundle:Building')->find($id);

        $building->setName($requestData['name']);
        $building->setWidth($requestData['width']);
        $building->setHeight($requestData['height']);
        $building->setPrice($requestData['price']);

        $this->em->flush();
    }

    public function deleteBuilding($id)
    {
        $building = $this->em->getRepository('AppBundle:Building')->find($id);
        $success = false;

        if ($building) {
            $this->em->remove($building);
            $this->em->flush();
            $success = true;
        }

        return $success;
    }

    
}