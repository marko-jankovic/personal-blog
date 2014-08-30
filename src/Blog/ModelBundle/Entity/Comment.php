<?php

namespace Blog\ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comment extends TimeStamp
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
     * @ORM\Column(name="authorName", type="string", length=100)
     * @Assert\NotBlank
     */
    private $authorName;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;


    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    private $post;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="origin")
     */
    private $answers;

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="answers")
     * @ORM\JoinColumn(name="origin_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $origin;


    /**
     * @ORM\Column(type="boolean")
     */
    protected $approved;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
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
     * Set authorName
     *
     * @param string $authorName
     * @return Comment
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get authorName
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set post
     *
     * @param \Blog\ModelBundle\Entity\Post $post
     *
     * @return Comment
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Blog\ModelBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Add answers
     *
     * @param $answers
     */
    public function addAnswer(Comment $answers)
    {
        $this->answers[] = $answers;
    }

    /**
     * Get answers
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set origin
     *
     * @param $origin
     *
     * @return Comment
     */
    public function setOrigin(Comment $origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Add answers
     *
     * @param $answers
     */
    public function addComment(Comment $answers)
    {
        $this->answers[] = $answers;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    /**
     * @return mixed
     */
    public function getApproved()
    {
        return $this->approved;
    }


    /**
     * Set user
     *
     * @param User $user
     *
     * @return Comment
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
