<?php

namespace Blog\ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantifier", type="integer")
     */
    private $quantifier;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    private $posts;

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
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set quantifier
     *
     * @param integer $quantifier
     * @return Tag
     */
    public function setQuantifier($quantifier)
    {
        $this->quantifier = $quantifier;

        return $this;
    }

    /**
     * Get quantifier
     *
     * @return integer 
     */
    public function getQuantifier()
    {
        return $this->quantifier;
    }


    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }


    /**
     * Add posts
     *
     * @param $posts
     *
     * @return post
     */
    public function addPost(Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Blog\ModelBundle\Entity\Post $posts
     */
    public function removePost(Post $posts)
    {
        $this->posts->removeElement($posts);
    }
}
