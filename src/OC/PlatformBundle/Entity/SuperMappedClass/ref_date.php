<?php
/**
 * Created by PhpStorm.
 * User: fsanon
 * Date: 05/01/2017
 * Time: 10:07
 */

namespace OC\PlatformBundle\Entity\SuperMappedClass;

use Doctrine\ORM\Mapping as ORM;

class ref_date
{
    /**
     * @ORM\Column(name="created_at",type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at",type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}