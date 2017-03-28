<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\RefCivilite;
use OC\PlatformBundle\Entity\RefDepartement;
use OC\PlatformBundle\Entity\RefHobbies;

class LoadDepartement implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            75,
            95,
        );

        $nameDepartement = array(
            'Paris',
            'Val d\'oise',
        );
        foreach ($names as $key => $name) {
            // On crée la catégorie
            $departement = new RefDepartement();
            $departement->setDepartement($name);
            $departement->setNomDepartement($nameDepartement[$key]);

            // On la persiste
            $manager->persist($departement);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }
}