<?php

/**
 * Created by PhpStorm.
 * User: zneel
 * Date: 22/10/2016
 * Time: 06:15
 */
namespace AppBundle\DBAL\Types;


use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class MaterielType extends AbstractEnumType
{
    const BOITIER         = 'BOITIER';
    const ALIMENTATION    = 'ALIMENTATION';
    const HDD             = 'HDD';
    const SSD             = 'SSD';
    const GRAVEUR         = 'GRAVEUR';
    const PROCESSEUR      = 'PROCESSEUR';
    const CARTE_MERE      = 'CARTE MERE';
    const MEMOIRE         = 'MEMOIRE';
    const RADIATEUR       = 'RADIATEUR';
    const CARTE_GRAPHIQUE = 'CARTE GRAPHIQUE';
    const AUTRE           = 'AUTRE';

    protected static $choices = [
        self::BOITIER         => 'Boitier',
        self::ALIMENTATION    => 'Alimentation',
        self::HDD             => 'Hdd',
        self::SSD             => 'Ssd',
        self::GRAVEUR         => 'Graveur',
        self::PROCESSEUR      => 'Processeur',
        self::CARTE_MERE      => 'Carte Mere',
        self::MEMOIRE         => 'Memoire Ram',
        self::RADIATEUR       => 'Radiateur',
        self::CARTE_GRAPHIQUE => 'Carte Graphique',
        self::CARTE_MERE      => 'Carte Mère',
        self::AUTRE           => 'Autre'
    ];

}