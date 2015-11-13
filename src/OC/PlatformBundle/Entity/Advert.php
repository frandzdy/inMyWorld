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
 * @ORM\Table(name="oc_advert")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\AdvertRepository")
 * @UniqueEntity(fields="title", message="Une annonce existe déjà avec ce titre.")
 * @ORM\HasLifecycleCallBacks()
 */
class Advert
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
	 * @Assert\DateTime()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
	 * @Assert\length(min=10, minMessage="Le titre doit faire au moins {{ limit }} caractères.")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
	 * @Assert\length(min=2, minMessage="Le nom de l'auteur doit faire au moins {{ limit }} caractères.")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
	 * @Assert\NotBlank
     */
    private $content;

	/**
 	* @var boolean
	* 
	* @ORM\Column(name="published", type="boolean")
	*/
 	private $published = true;
 	/**
  	* @var string
  	* 
  	* @ORM\Column(name="creator", type="string")
  	*/
  	private $creator;
  	/**
   	* 
   	* @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist","remove"})
 	* @Assert\Valid()
   	*/
   	private $image;
   	/**
   	* 
   	* @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Category")
   	*/
   	private $categories;
	
	
	/**
   	* 
   	* @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\User")
   	*/
   	private $chat;
   	/**
   	* 
   	* @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Application", mappedBy="advert")
   	*/
   	private $applications;
	/**
	 * @ORM\Column(name="updated_at",type="datetime",nullable=true)
	 */
	private $updatedAt;
	
	/**
	 * @ORM\Column(name="nb_application",type="integer")
	 */
	private $nbApplications = 0;
	/**
   	* 
   	* @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Commentaire", mappedBy="Commentaire")
   	*/
   	private $commentaires;
	
	private $name;
	
 	public function __construct()
  	{
    	// Par défaut, la date de l'annonce est la date d'aujourd'hui
	    $this -> date = new \Datetime();
		$this -> creator = "Frandzdy Sanon";
		$this -> categories = new ArrayCollection();
		$this -> applications = new ArrayCollection();
		$this -> commentaires = new ArrayCollection();
  	}
	
	
	
  	public function getName()
  	{
    	return $this -> name;
  	}

  	public function setName($name)
  	{
    	$this -> name[] = $name;
  	}
	
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Advert
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set creator
     *
     * @param string $creator
     *
     * @return Advert
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set image
     *
     * @param \OC\PlatformBundle\Entity\Image $image
     *
     * @return Advert
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
     * Add category
     *
     * @param \OC\PlatformBundle\Entity\Category $category
     *
     * @return Advert
     */
    public function addCategory(\OC\PlatformBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \OC\PlatformBundle\Entity\Category $category
     */
    public function removeCategory(\OC\PlatformBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add application
     *
     * @param \OC\PlatformBundle\Entity\Application $application
     *
     * @return Advert
     */
    public function addApplication(\OC\PlatformBundle\Entity\Application $application)
    {
        $this->applications[] = $application;
		
		// On lie l'annonce à la candidature
	    $application -> setAdvert($this);
    
	    return $this;
    }

    /**
     * Remove application
     *
     * @param \OC\PlatformBundle\Entity\Application $application
     */
    public function removeApplication(\OC\PlatformBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }
	
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Advert
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
	
	/**
	 * @ORM\PreUpdate
	 */
	public function updateDate()
	{
		$this -> setUpdatedAt(new \DateTime());
	}
	
	public function increaseApplication()
	{
		$this -> nbApplications++;
	}
	public function decreaseApplication()
	{
		$this -> nbApplications--;
	}

    /**
     * Set nbApplications
     *
     * @param integer $nbApplications
     *
     * @return Advert
     */
    public function setNbApplications($nbApplications)
    {
        $this->nbApplications = $nbApplications;

        return $this;
    }

    /**
     * Get nbApplications
     *
     * @return integer
     */
    public function getNbApplications()
    {
        return $this->nbApplications;
    }
 	/**
   	* @Assert\Callback
   	*/
  	public function isContentValid(ExecutionContextInterface $context)
  	{
	    $forbiddenWords = array('échec', 'abandon');
	    // On vérifie que le contenu ne contient pas l'un des mots
	    if (preg_match('#'.implode('|', $forbiddenWords).'#', $this->getContent())) {
	      // La règle est violée, on définit l'erreur
	      $context
	        ->buildViolation('Contenu invalide car il contient un mot interdit.') // message
	        ->atPath('title')                                                   // attribut de l'objet qui est violé
	        ->addViolation() // ceci déclenche l'erreur, ne l'oubliez pas
	      ;
	    }
  	}

    /**
     * Add chat
     *
     * @param \OC\UserBundle\Entity\User $chat
     *
     * @return Advert
     */
    public function addChat(\OC\UserBundle\Entity\User $chat)
    {
        $this->chat[] = $chat;

        return $this;
    }

    /**
     * Remove chat
     *
     * @param \OC\UserBundle\Entity\User $chat
     */
    public function removeChat(\OC\UserBundle\Entity\User $chat)
    {
        $this->chat->removeElement($chat);
    }

    /**
     * Get chat
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * Add commentaire
     *
     * @param \OC\PlatformBundle\Entity\Commentaire $commentaire
     *
     * @return Advert
     */
    public function addCommentaire(\OC\PlatformBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \OC\PlatformBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\OC\PlatformBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
