<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\Parser;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use AppBundle\Entity\Building;
use AppBundle\Service\BuildingManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/building")
 * @Security("has_role('ROLE_SUPER_ADMIN')")
 */
class BuildingController extends JsonController
{
    /**
     * @Route("/list")
     * @Method("GET")
     */
    public function listBuildingsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $context = SerializationContext::create()->setGroups(array('buildingList'));
        $request = $this->getRequest();

        $query = $request->query->get('query');
        $pagesize = $request->query->get('limit');
        $orderBy = $request->query->get('orderBy');
        $ascending = $request->query->get('ascending');
        $page = $request->query->get('page');
        $sorting = array ($orderBy => $ascending > 0 ? 'ASC' : 'DESC');

        try {
            $buildings = $this->getDoctrine()->getRepository('AppBundle:Building')->findByWithPagin($query, $sorting, $page, $pagesize);
            $buildings = json_decode(SerializerBuilder::create()->build()->serialize($buildings, 'json', $context));

        } catch (Exception $e){
            return $this->JsonFail($e);
        }

        $count = $this->getDoctrine()->getRepository('AppBundle:Building')->count($query, $sorting, $page, $pagesize);

        return $this->JsonData($buildings, $count);
    }

    /**
     * @Route("/{id}")
     * @Method("get")
     */
    public function getBuildingAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $requestData = json_decode($request->getContent(), true);
        $context = SerializationContext::create()->setGroups(array('buildingList'));
        
        try{
            $building = $this->getDoctrine()->getRepository('AppBundle:Building')->find($id);

            $building = json_decode(SerializerBuilder::create()->build()->serialize($building, 'json', $context));
        } catch (Exception $e){
            return $this->JsonFail($e);
        }
        return $this->JsonData($building);
    }


    /**
     * @Route("")
     * @Method("POST")
     */
    public function addBuildingAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestData = json_decode($request->getContent(), true);
        try {
            $id = $this->get('app.building_manager')->createBuilding($requestData);

        } catch(Exception $e) {
            return $this->JsonFail('Wystąpił błąd');
        }

        return $this->JsonData($id);
    }

    /**
     * @Route("/{id}")
     * @Method("PUT")
     */
    public function updateBuildingAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $requestData = json_decode($request->getContent(), true);
        try {
            $this->get('app.building_manager')->updateBuilding($requestData, $id);

        } catch(Exception $e) {
            return $this->JsonFail('Wystąpił błąd');
        }

        return $this->JsonSuccess("Zaktualizowano budynek");
    }

     /**
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteBuildingAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            $result = $this->get('app.building_manager')->deleteBuilding($id);

        } catch(Exception $e) {
            return $this->JsonFail('Wystąpił błąd');
        }

        if (!$result) {
            return $this->JsonFail('Wystąpił błąd');
        }

        return $this->JsonSuccess("Usunięto budynek");
    }
}