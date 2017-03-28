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
 * @ORM\Table(name="ref_sexe")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\RefSexeRepository")
 * @ORM\HasLifecycleCallBacks()
 */
class RefSexe
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
     * @ORM\Column(name="sexe", type="text")
     * @Assert\NotBlank
     */
    private $sexe;

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
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

}
