<?php
// src/OC/UserBundle/Entity/User.php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo;

// contrainte sur les attributs de la classe Advert
use OC\PlatformBundle\Entity\RefCivilite;
use OC\PlatformBundle\Entity\RefHobbies;
use Symfony\Component\Validator\Constraints as Assert;

// pareil validation du formulaire
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="lastname", type="text")
     */
    private $lastname;
    /**
     * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\RefHobbies", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $preferences;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\RefCivilite")
     * @Assert\Valid()
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\RefDepartement")
     * @Assert\Valid()
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\RefDepartement")
     * @Assert\Valid()
     */
    private $preferenceDepartements;

    /**
     * @ORM\Column(name="date_naissance", type="datetime")
     */

    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\RefSexe")
     * @Assert\Valid()
     */
    private $preferenceSexes;

    /**
     * User constructor.
     */

    public function __construct()
    {
        parent::__construct();
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        // $this -> date = new \Datetime();
        // $this -> creator = "Frandzdy Sanon";
        $this->preferences = new ArrayCollection();
        // $this -> commentaires = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param \OC\PlatformBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\OC\PlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \OC\PlatformBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add preference
     *
     * @param \OC\PlatformBundle\Entity\RefHobbies $preference
     *
     * @return User
     */
    public function addPreference(\OC\PlatformBundle\Entity\RefHobbies $preference)
    {
        $this->preferences[] = $preference;

        return $this;
    }

    /**
     * Remove preference
     *
     * @param \OC\PlatformBundle\Entity\RefHobbies $preference
     */
    public function removePreference(\OC\PlatformBundle\Entity\RefHobbies $preference)
    {
        $this->preferences->removeElement($preference);
    }

    /**
     * Get preferences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * Set civilite
     *
     * @param \OC\PlatformBundle\Entity\RefCivilite $civilite
     *
     * @return RefCivilite
     */
    public function setCivilite(\OC\PlatformBundle\Entity\RefCivilite $civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get Civilite
     *
     * @return \OC\PlatformBundle\Entity\RefCivilite
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set Departement
     *
     * @param \OC\PlatformBundle\Entity\RefDepartement $civilite
     *
     * @return RefCivilite
     */
    public function setDepartement(\OC\PlatformBundle\Entity\RefDepartement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get Departement
     *
     * @return \OC\PlatformBundle\Entity\RefDepartement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Add preferenceDepartement
     *
     * @param \OC\PlatformBundle\Entity\RefDepartement $preferenceDepartement
     *
     * @return User
     */
    public function addPreferenceDepartement(\OC\PlatformBundle\Entity\RefDepartement $preferenceDepartement)
    {
        $this->preferenceDepartements[] = $preferenceDepartement;

        return $this;
    }

    /**
     * Remove preferenceDepartement
     *
     * @param \OC\PlatformBundle\Entity\RefDepartement $preferenceDepartement
     */
    public function removePreferenceDepartement(\OC\PlatformBundle\Entity\RefDepartement $preferenceDepartement)
    {
        $this->preferenceDepartements->removeElement($preferenceDepartement);
    }

    /**
     * Get preferenceDepartements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPreferenceDepartements()
    {
        return $this->preferenceDepartements;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Add preferenceDepartement
     *
     * @param \OC\PlatformBundle\Entity\RefDepartement $preferenceDepartement
     *
     * @return User
     */
    public function addPreferenceSexe(\OC\PlatformBundle\Entity\RefSexe $preferenceSexe)
    {
        $this->preferenceSexes[] = $preferenceSexe;

        return $this;
    }

    /**
     * Remove preferenceDepartement
     *
     * @param \OC\PlatformBundle\Entity\RefDepartement $preferenceDepartement
     */
    public function removePreferenceSexe(\OC\PlatformBundle\Entity\RefSexe $preferenceSexe)
    {
        $this->preferenceSexes->removeElement($preferenceSexe);
    }

    /**
     * Get preferenceDepartements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPreferenceSexes()
    {
        return $this->preferenceSexes;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
}
