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
 * @ORM\Table(name="ref_departement")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\RefDepartementRepository")
 * @ORM\HasLifecycleCallBacks()
 */
class RefDepartement
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
     * @ORM\Column(name="departement", type="integer")
     * @Assert\NotBlank
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_departement", type="text")
     * @Assert\NotBlank
     */
    private $nomDepartement;
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
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param string $departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }

    /**
     * @return string
     */
    public function getNomDepartement()
    {
        return $this->nomDepartement;
    }

    /**
     * @param string $departement
     */
    public function setNomDepartement($nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;
    }

    /**
     * @return string
     */
    public function getConcatenationDepartementNomDepartement() {

        return $this->getDepartement(). ' - ' . $this->getNomDepartement();
    }
}
