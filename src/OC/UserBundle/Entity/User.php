<?php
// src/OC/UserBundle/Entity/User.php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo;

// contrainte sur les attributs de la classe Advert
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
     * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist","remove"})
     * @Assert\Valid()
     */
    private $image;

//	 /**
//     * @var string
//     *
//     * @ORM\Column(name="date_naissance", type="datetime")
//	 * @Assert\datetime()
//     */
//	private $dateNaissance;
//	 /**
//     * @var string
//     *
//     * @ORM\Column(name="genre", type="string")
//	 * @Assert\Valid()
//     */
//	private $genre;
//	 /**
//     * @var string
//     *
//     * @ORM\Column(name="departement", type="integer")
//	 * @Assert\Valid()
//     */
//	private $departement;
//	 /**
//     * @var string
//     *
//     * @ORM\Column(name="commentaire", type="string")
//	 * @Assert\Valid()
//     */
//	private commentaire;


    public function __construct()
    {
        parent::__construct();
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        // $this -> date = new \Datetime();
        // $this -> creator = "Frandzdy Sanon";
        // $this -> categories = new ArrayCollection();
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
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
//    public function setDateNaissance($dateNaissance)
//    {
//        $this->dateNaissance = $dateNaissance;
//
//        return $this;
//    }
//
//    /**
//     * Get dateNaissance
//     *
//     * @return \DateTime
//     */
//    public function getDateNaissance()
//    {
//        return $this->dateNaissance;
//    }
//
//    /**
//     * Set genre
//     *
//     * @param string $genre
//     *
//     * @return User
//     */
//    public function setGenre($genre)
//    {
//        $this->genre = $genre;
//
//        return $this;
//    }
//
//    /**
//     * Get genre
//     *
//     * @return string
//     */
//    public function getGenre()
//    {
//        return $this->genre;
//    }
//
//    /**
//     * Set departement
//     *
//     * @param \int $departement
//     *
//     * @return User
//     */
//    public function setDepartement(\int $departement)
//    {
//        $this->departement = $departement;
//
//        return $this;
//    }
//
//    /**
//     * Get departement
//     *
//     * @return \int
//     */
//    public function getDepartement()
//    {
//        return $this->departement;
//    }

//    /**
//     * Add commentaire
//     *
//     * @param \OC\PlatformBundle\Entity\Commentaire $commentaire
//     *
//     * @return User
//     */
//    public function addCommentaire(\OC\PlatformBundle\Entity\Commentaire $commentaire)
//    {
//        $this->commentaires[] = $commentaire;
//
//        return $this;
//    }

//    /**
//     * Remove commentaire
//     *
//     * @param \OC\PlatformBundle\Entity\Commentaire $commentaire
//     */
//    public function removeCommentaire(\OC\PlatformBundle\Entity\Commentaire $commentaire)
//    {
//        $this->commentaires->removeElement($commentaire);
//    }
//
//    /**
//     * Get commentaires
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getCommentaires()
//    {
//        return $this->commentaires;
//    }

}
