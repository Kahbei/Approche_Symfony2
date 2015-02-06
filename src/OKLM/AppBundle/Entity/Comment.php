<?php

namespace OKLM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use OKLM\CommonBundle\Traits\Doctrine as OKLMDB;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="OKLM\AppBundle\Entity\CommentRepository")
 */
class Comment
{
    use OKLMDB\Id,
        ORMBehaviors\Timestampable\Timestampable
        ;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="OKLM\AppBundle\Entity\Article", inversedBy="comment")
     */
    private $article;

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
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
     * Set name
     *
     * @param string $name
     * @return Comment
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
     * Set email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     *
     * @return $this
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    public function __toString()
    {
        return $this->getName().' <'.$this->getEmail().'>';
    }
}
