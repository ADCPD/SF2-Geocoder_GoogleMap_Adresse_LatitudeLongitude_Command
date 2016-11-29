<?php

namespace GeoCodeurBundle\Controller;


use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManager;
use GeoCodeurBundle\Entity\AdresseCmt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lsw\ApiCallerBundle\Call\HttpGetJson;

/**
 * Class DefaultController
 * @package GeoCodeurBundle\Controller
 */
class DefaultController extends Controller
{

    public function sauvegarde()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $adress = $em->getRepository("GeoCodeurBundle:AdresseCmt")->findAll();
        foreach ($adress as $location) {
            /** @var AdresseCmt $location */
            $location = new AdresseCmt();
            $FormattedAddress = $location->getFormattedAddress();
            $_url = "http://maps.google.com/maps/api/geocode/json?sensor=true&address=" . urlencode($FormattedAddress) . "&sensor=false";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $_url,
                CURLOPT_HTTPGET => 1,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            $resp = curl_exec($curl);
            $json = json_decode($resp, true);
            if (\array_key_exists('results', $json) && $json['results']) {

                $lati = $json['results'][0]['geometry']['location']['lat'];
                $longi = $json['results'][0]['geometry']['location']['lng'];

                $location->setLatitudeCmt($lati);
                $location->setLongitudeCmt($longi);

                $em->persist($location);
                $em->flush();
            }
        }
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $adresses = $em->getRepository("GeoCodeurBundle:AdresseCmt")->findAll();


        return $this->render('GeoCodeurBundle:Default:index.html.twig',
            array(
                "total" => count($adresses),
                'entities' => $adresses,
            ));

    }

}
