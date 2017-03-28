<?php
// src/OC/UserBundle/DataFixtures/ORM/LoadUser.php

namespace OC\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\RefCivilite;
use OC\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
        $listNames = array('Alexandre', 'Marine', 'Anna', 'zyf');
        foreach ($listNames as $key => $name) {
            $date = new \DateTime();
            // On crée l'utilisateur
            $user = new User();
            // Le nom d'utilisateur et le mot de passe sont identiques
            $user->setUsername($name)
            ->setPlainPassword($name)
            ->setEmail($name . "@yopmail.com")->setDateNaissance($date)
            ->setEnabled(true)
            // On définit uniquement le role ROLE_USER qui est le role de base
            ->setRoles(array('ROLE_ADMIN'));
            // On le persiste
            $manager->persist($user);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }

    public function getOrder() {
        return 999;
    }
}