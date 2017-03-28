<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

// contrainte sur les attributs de la classe Advert
use Symfony\Component\Validator\Constraints as Assert;

// vérification de l'unicité de la classe unique
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

// pareil validation du formulaire
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Advert
 *
 * @ORM\Table(name="ref_hobbies")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\RefHobbiesRepository")
 * @ORM\HasLifecycleCallBacks()
 */
class RefHobbies
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
     * @var string
     *
     * @ORM\Column(name="preference", type="text")
     * @Assert\NotBlank
     */
    private $preferences;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param string $preference
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }

}
