<?php

namespace OC\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chat
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Chat
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
     * @ORM\Column(name="discussion", type="string", length=255)
     */
    private $discussion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="time")
     */
    private $date;

    /**
     * @var array
     * 
	 * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User")
     * @ORM\Column(name="user1", type="array")
     */
    private $user1;

    /**
     * @var array
     * 
	 * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User")
     * @ORM\Column(name="user2", type="array")
     */
    private $user2;


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
     * Set discussion
     *
     * @param string $discussion
     *
     * @return Chat
     */
    public function setDiscussion($discussion)
    {
        $this->discussion = $discussion;

        return $this;
    }

    /**
     * Get discussion
     *
     * @return string
     */
    public function getDiscussion()
    {
        return $this->discussion;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Chat
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
     * Set user1
     *
     * @param array $user1
     *
     * @return Chat
     */
    public function setUser1($user1)
    {
        $this->user1 = $user1;

        return $this;
    }

    /**
     * Get user1
     *
     * @return array
     */
    public function getUser1()
    {
        return $this->user1;
    }

    /**
     * Set user2
     *
     * @param array $user2
     *
     * @return Chat
     */
    public function setUser2($user2)
    {
        $this->user2 = $user2;

        return $this;
    }

    /**
     * Get user2
     *
     * @return array
     */
    public function getUser2()
    {
        return $this->user2;
    }
}
