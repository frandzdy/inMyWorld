<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\RefHobbies;

class LoadHobbies implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'Exposition / Musé',
            'Concert',
            'Jeux vidéo',
            'Sport',
            'Science'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $hobbies = new RefHobbies();
            $hobbies->setTitle($name);

            // On la persiste
            $manager->persist($hobbies);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}