<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use AppBundle\Entity\City;
use AppBundle\Entity\Cityconfig;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/city")
 */
class CityController extends JsonController
{
    /**
     * @Route("")
     * @Method("POST")
     */
    public function addCityAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestData = json_decode($request->getContent(), true);
        try {
            $this->get('app.city_manager')->createCity($requestData);

        } catch(Exception $e) {
            return $this->JsonFail('Wystąpił błąd');
        }

        return $this->JsonSuccess("Dodano miasto");
    }

    /**
     * @Route("/list")
     * @Method("GET")
     */
    public function listCitiesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $context = SerializationContext::create()->setGroups(array('cityList'));

        try {
            $cities = $this->getDoctrine()->getRepository('AppBundle:City')->findAll();
            $cities = json_decode(SerializerBuilder::create()->build()->serialize($cities, 'json', $context));

        } catch (Exception $e){
            return $this->JsonFail($e);
        }
        return $this->JsonData($cities);
    }

    /**
     * @Route("/{id}")
     * @Method("get")
     */
    public function getCityAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $requestData = json_decode($request->getContent(), true);
        $context = SerializationContext::create()->setGroups(array('cityList'));
        
        try{
            $city = $this->getDoctrine()->getRepository('AppBundle:City')->find($id);

            $city = json_decode(SerializerBuilder::create()->build()->serialize($city, 'json', $context));
        } catch (Exception $e){
            return $this->JsonFail($e);
        }
        return $this->JsonData($city);
    }
}