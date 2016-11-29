<?php

/**
 * Created by PhpStorm.
 * User: dhaouadi_a
 * Date: 23/11/2016
 * Time: 16:32
 *  Adresse
 */

namespace GeoCodeurBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use GeoCodeurBundle\Api\CurlCaller;
use GeoCodeurBundle\Controller\DefaultController;

/**
 * @ORM\Table(name="geocode_adresse")
 * @ORM\Entity(repositoryClass="GeoCodeurBundle\Repository\AdresseCmtRepository")
 */
class AdresseCmt
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;
    /**
     * @var String
     * @ORM\Column(name="adresse_cmt", type="string", length=255, nullable=true)
     */
    private $adresse_cmt;

    /**
     * @var String
     * @ORM\Column(name="adresse_cmt_ligne_2", type="string", length=255, nullable=true)
     */
    private $adresse_cmt_ligne_2;

    /**
     * @var String
     * @ORM\Column(name="adresse_cmt_ligne_3", type="string", length=255, nullable=true)
     */
    private $adresse_cmt_ligne_3;

    /**
     * @var String
     * @ORM\Column(name="code_postal_cmt", type="string", length=6, nullable=true)
     */
    private $code_postal_cmt;

    /**
     * @var String
     * @ORM\Column(name="ville_cmt", type="string", length=255, nullable=true)
     */
    private $ville_cmt;

    /**
     * @var String
     * @ORM\Column(name="latitude", type="string", length=50, nullable=true)
     */
    private $latitude_cmt;

    /**
     * @var String
     * @ORM\Column(name="longitude", type="string", length=50, nullable=true)
     */
    private $longitude_cmt;


    /**
     * Adresse constructor.
     */
    public function __construct()
    {

    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getAdresseCmt()
    {
        return $this->adresse_cmt;
    }

    /**
     * @param String $adresse_cmt
     */
    public function setAdresseCmt($adresse_cmt)
    {
        $this->adresse_cmt = $adresse_cmt;
    }

    /**
     * @return String
     */
    public function getAdresseCmtLigne2()
    {
        return $this->adresse_cmt_ligne_2;
    }

    /**
     * @param String $adresse_cmt_ligne_2
     */
    public function setAdresseCmtLigne2($adresse_cmt_ligne_2)
    {
        $this->adresse_cmt_ligne_2 = $adresse_cmt_ligne_2;
    }

    /**
     * @return String
     */
    public function getAdresseCmtLigne3()
    {
        return $this->adresse_cmt_ligne_3;
    }

    /**
     * @param String $adresse_cmt_ligne_3
     */
    public function setAdresseCmtLigne3($adresse_cmt_ligne_3)
    {
        $this->adresse_cmt_ligne_3 = $adresse_cmt_ligne_3;
    }

    /**
     * @return String
     */
    public function getCodePostalCmt()
    {
        return $this->code_postal_cmt;
    }

    /**
     * @param String $code_postal_cmt
     */
    public function setCodePostalCmt($code_postal_cmt)
    {
        $this->code_postal_cmt = $code_postal_cmt;
    }

    /**
     * @return String
     */
    public function getVilleCmt()
    {
        return $this->ville_cmt;
    }

    /**
     * @param String $ville_cmt
     */
    public function setVilleCmt($ville_cmt)
    {
        $this->ville_cmt = $ville_cmt;
    }

    /**
     * @return String
     */
    public function getLatitudeCmt()
    {
        return $this->latitude_cmt;
    }

    /**
     * @param String $latitude_cmt
     */
    public function setLatitudeCmt($latitude_cmt)
    {
        $this->latitude_cmt = $latitude_cmt;
    }

    /**
     * @return String
     */
    public function getLongitudeCmt()
    {
        return $this->longitude_cmt;
    }

    /**
     * @param String $longitude_cmt
     */
    public function setLongitudeCmt($longitude_cmt)
    {
        $this->longitude_cmt = $longitude_cmt;
    }

    /**
     * Method qui retourne adresse complete
     *
     * @return string
     */
    public function getFormattedAddress()
    {
        return $this->__toString();

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getAdresseCmt() . "+" .
            $this->getAdresseCmtLigne2() . "+" .
            $this->getAdresseCmtLigne3() . "," .
            $this->getCodePostalCmt() . "," .
            $this->getVilleCmt() . ", France";
    }


}