<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pc
 *
 * @ORM\Table(name="pc")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PcRepository")
 */
class Pc
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
     * @ORM\Column(name="boitier", type="string", length=255)
     */
    private $boitier;

    /**
     * @var string
     *
     * @ORM\Column(name="alimentation", type="string", length=255)
     */
    private $alimentation;

    /**
     * @var string
     *
     * @ORM\Column(name="hdd", type="string", length=255)
     */
    private $hdd;

    /**
     * @var string
     *
     * @ORM\Column(name="ssd", type="string", length=255)
     */
    private $ssd;

    /**
     * @var string
     *
     * @ORM\Column(name="graveur", type="string", length=255)
     */
    private $graveur;

    /**
     * @var string
     *
     * @ORM\Column(name="processeur", type="string", length=255)
     */
    private $processeur;

    /**
     * @var string
     *
     * @ORM\Column(name="carteMere", type="string", length=255)
     */
    private $carteMere;

    /**
     * @var string
     *
     * @ORM\Column(name="memoire", type="string", length=255)
     */
    private $memoire;

    /**
     * @var string
     *
     * @ORM\Column(name="radiateur", type="string", length=255)
     */
    private $radiateur;

    /**
     * @var string
     *
     * @ORM\Column(name="systemeExploitation", type="string", length=255)
     */
    private $systemeExploitation;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="vendable", type="boolean")
     */
    private $vendable;

    /**
     * @var string
     *
     * @ORM\Column(name="carteGraphique", type="string", length=255)
     */
    private $carteGraphique;

    /**
     * @var string
     *
     * @ORM\Column(name="ecran", type="string", length=255)
     */
    private $ecran;


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
     * Set boitier
     *
     * @param string $boitier
     *
     * @return Pc
     */
    public function setBoitier($boitier)
    {
        $this->boitier = $boitier;

        return $this;
    }

    /**
     * Get boitier
     *
     * @return string
     */
    public function getBoitier()
    {
        return $this->boitier;
    }

    /**
     * Set alimentation
     *
     * @param string $alimentation
     *
     * @return Pc
     */
    public function setAlimentation($alimentation)
    {
        $this->alimentation = $alimentation;

        return $this;
    }

    /**
     * Get alimentation
     *
     * @return string
     */
    public function getAlimentation()
    {
        return $this->alimentation;
    }

    /**
     * Set hdd
     *
     * @param string $hdd
     *
     * @return Pc
     */
    public function setHdd($hdd)
    {
        $this->hdd = $hdd;

        return $this;
    }

    /**
     * Get hdd
     *
     * @return string
     */
    public function getHdd()
    {
        return $this->hdd;
    }

    /**
     * Set ssd
     *
     * @param string $ssd
     *
     * @return Pc
     */
    public function setSsd($ssd)
    {
        $this->ssd = $ssd;

        return $this;
    }

    /**
     * Get ssd
     *
     * @return string
     */
    public function getSsd()
    {
        return $this->ssd;
    }

    /**
     * Set graveur
     *
     * @param string $graveur
     *
     * @return Pc
     */
    public function setGraveur($graveur)
    {
        $this->graveur = $graveur;

        return $this;
    }

    /**
     * Get graveur
     *
     * @return string
     */
    public function getGraveur()
    {
        return $this->graveur;
    }

    /**
     * Set processeur
     *
     * @param string $processeur
     *
     * @return Pc
     */
    public function setProcesseur($processeur)
    {
        $this->processeur = $processeur;

        return $this;
    }

    /**
     * Get processeur
     *
     * @return string
     */
    public function getProcesseur()
    {
        return $this->processeur;
    }

    /**
     * Set carteMere
     *
     * @param string $carteMere
     *
     * @return Pc
     */
    public function setCarteMere($carteMere)
    {
        $this->carteMere = $carteMere;

        return $this;
    }

    /**
     * Get carteMere
     *
     * @return string
     */
    public function getCarteMere()
    {
        return $this->carteMere;
    }

    /**
     * Set memoire
     *
     * @param string $memoire
     *
     * @return Pc
     */
    public function setMemoire($memoire)
    {
        $this->memoire = $memoire;

        return $this;
    }

    /**
     * Get memoire
     *
     * @return string
     */
    public function getMemoire()
    {
        return $this->memoire;
    }

    /**
     * Set radiateur
     *
     * @param string $radiateur
     *
     * @return Pc
     */
    public function setRadiateur($radiateur)
    {
        $this->radiateur = $radiateur;

        return $this;
    }

    /**
     * Get radiateur
     *
     * @return string
     */
    public function getRadiateur()
    {
        return $this->radiateur;
    }

    /**
     * Set systemeExploitation
     *
     * @param string $systemeExploitation
     *
     * @return Pc
     */
    public function setSystemeExploitation($systemeExploitation)
    {
        $this->systemeExploitation = $systemeExploitation;

        return $this;
    }

    /**
     * Get systemeExploitation
     *
     * @return string
     */
    public function getSystemeExploitation()
    {
        return $this->systemeExploitation;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Pc
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set vendable
     *
     * @param boolean $vendable
     *
     * @return Pc
     */
    public function setVendable($vendable)
    {
        $this->vendable = $vendable;

        return $this;
    }

    /**
     * Get vendable
     *
     * @return bool
     */
    public function getVendable()
    {
        return $this->vendable;
    }

    /**
     * Set carteGraphique
     *
     * @param string $carteGraphique
     *
     * @return Pc
     */
    public function setCarteGraphique($carteGraphique)
    {
        $this->carteGraphique = $carteGraphique;

        return $this;
    }

    /**
     * Get carteGraphique
     *
     * @return string
     */
    public function getCarteGraphique()
    {
        return $this->carteGraphique;
    }

    /**
     * Set ecran
     *
     * @param string $ecran
     *
     * @return Pc
     */
    public function setEcran($ecran)
    {
        $this->ecran = $ecran;

        return $this;
    }

    /**
     * Get ecran
     *
     * @return string
     */
    public function getEcran()
    {
        return $this->ecran;
    }
}

