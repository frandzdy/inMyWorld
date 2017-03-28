<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\RefCivilite;
use OC\PlatformBundle\Entity\RefHobbies;
use OC\PlatformBundle\Entity\RefSexe;

class LoadSexe implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'Homme',
            'Femme',
            'les deux'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $sexe = new RefSexe();
            $sexe->setSexe($name);

            // On la persiste
            $manager->persist($sexe);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }
}