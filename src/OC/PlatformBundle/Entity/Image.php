<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="oc_image")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;


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
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    private $file;
    private $tempfilename;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $files = null)
    {
        $this->file = $files;

        // lorsque le formulaire rempli l'objet il se peut que ce soit une modification
        // dans ce cas on regarde si notre objet posssède déjà une image
        if (null !== $this->url) {
            $this->tempfileName = $this->url;

            $this->alt = null;
            $this->url = null;
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // si on a pas de fichier on annule
        if (null === $this->file)
            return;
        // après le persist ou update on regarde si on a un ancien fichier si oui on le supprime
        if (null !== $this->tempfilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->tempfileName;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        // on déplace le fichier
        $this->file->move($this->getUploadRootDir(), $this->url);

        unset($this->file);
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function PreUpload()
    {
        // si j'ai pas de fichier alors on annule
        if (null === $this->file)
            return;

        $this->url = $this->id . '.' . $this->file->getClientOriginalName();
        $this->alt = $this->file->getClientOriginalName();
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
        $this->tempfilename = $this->getUploadRootDir() . '/' . $this->id . "." . $this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempfilename) and !is_dir($this->tempfilename)) {
            // On supprime le fichier
            unlink($this->tempfilename);
        }
    }

    public function getUploadDir()
    {
        return 'uploads/img';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    // retourne le chemin du fichier pour l'afficher dans la vue
    public function getPathView()
    {
        return $this->getUploadDir() . '/' . $this->url;
    }
}
