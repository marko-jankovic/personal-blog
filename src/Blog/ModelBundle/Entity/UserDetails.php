<?php

namespace Blog\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Blog\ModelBundle\Repository\UserDetailsRepository")
 */
class UserDetails extends TimeStamp
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Image", mappedBy="details")
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=150, nullable=true)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=150, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=150, nullable=true)
     */
    private $location;


    /**
     * @var string
     *
     * @ORM\Column(name="github", type="string", length=150, nullable=true)
     */
    private $github;


    /**
     * @var string
     *
     * @ORM\Column(name="linkedin", type="string", length=150, nullable=true)
     */
    private $linkedin;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=150, nullable=true)
     */
    private $twitter;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    private $user;


    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $github
     */
    public function setGithub($github)
    {
        $this->github = $github;
    }

    /**
     * @return string
     */
    public function getGithub()
    {
        return $this->github;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param \Blog\ModelBundle\Entity\User $user
     *
     * @return UserDetails
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Blog\ModelBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return UserDetails
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add images
     *
     * @param Image $avatar
     *
     * @return this
     */
    public function addAvatar(Image $avatar)
    {
        $this->avatar[] = $avatar;

        return $this;
    }

    /**
     * Remove avatar
     *
     * @param Image $avatar
     */
    public function removeAvatar(Image $avatar)
    {
        $this->images->removeElement($avatar);
    }
}
