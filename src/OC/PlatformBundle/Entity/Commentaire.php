<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\Column(name="contenu", type="string", length=500)
     */
    private $contenu;
//
//    /**
//     * @var
//     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Advert", cascade={"persist","remove"}, inversedBy="commentaire")
//     */
//
//    private $advert;
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return commentaire
     */
    public function setCommentaire($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->contenu;
    }

//    /**
//     * @return mixed
//     */
//    public function getAdvert()
//    {
//        return $this->advert;
//    }
//
//    /**
//     * @param mixed $post
//     */
//    public function setAdvert($advert)
//    {
//        $this->advert = $advert;
//    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}
