<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\RefCivilite;
use OC\PlatformBundle\Entity\RefHobbies;

class LoadCivilite implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'Monsieur',
            'Madame',
            'Mademoiselle',
            'les deux'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $civilite = new RefCivilite();
            $civilite->setCivilite($name);

            // On la persiste
            $manager->persist($civilite);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder() {
        return 1;
    }
}