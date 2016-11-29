<?php

namespace GeoCodeurBundle\Command;

use GeoCodeurBundle\Entity\AdresseCmt;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LatitudeLongitudeCommand
 * @package  GeoCodeurBundle\Command
 */
class LatitudeLongitudeCommand extends ContainerAwareCommand
{


    /**
     *  Command name
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('geocode:latitude_longite:add')
            ->setDescription('Commande qui permet surcharger les données d\'latitude,longite liées lier à  des adresses données ');
    }


    /**
     * {@inheritdoc}
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $adresses = $em->getRepository("GeoCodeurBundle:AdresseCmt")->findBy(array('latitude_cmt' => null));

        /** @var AdresseCmt $adresse */
        $adresse = new AdresseCmt();

        foreach ($adresses as $adresse) {
            sleep(5);
            $ville = strtoupper($adresse->getFormattedAddress());
            $FormattedAddress = str_replace("CEDEX", "", $ville);
            $region = 'FRANCE';
            //$_url = "http://maps.google.com/maps/api/geocode/json?sensor=true&address=" . urlencode($FormattedAddress) . "&sensor=false";
            $_url = "http://maps.google.com/maps/api/geocode/json?sensor=true&address=" . urlencode($FormattedAddress) . "&sensor=false&region=" . $region;

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


                if (is_null($adresse->getLatitudeCmt())) {
                    $adresse->setLatitudeCmt($lati);
                }

                if (is_null($adresse->getLongitudeCmt())) {
                    $adresse->setLongitudeCmt($longi);
                }


                $em->persist($adresse);
                $em->flush();
            }
        }
    }


}
