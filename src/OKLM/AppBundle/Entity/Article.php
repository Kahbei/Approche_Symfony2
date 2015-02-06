<?php

namespace OKLM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use OKLM\CommonBundle\Traits\Doctrine as OKLMDB;
use OKLM\AppBundle\Entity\Comment;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="OKLM\AppBundle\Entity\ArticleRepository")
 */
class Article
{
    use OKLMDB\Id,
        ORMBehaviors\Timestampable\Timestampable,
        ORMBehaviors\Sluggable\Sluggable
    ;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var Comment
     *
     * @ORM\OneToMany(targetEntity="OKLM\AppBundle\Entity\Comment", mappedBy="article")
     */
    private $comment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
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
     * Set content
     *
     * @param string $content
     * @return Article
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
     * @return array
     */
    public function getSluggableFields()
    {
        return [ 'title' ];
    }

    /**
     * Add comment
     *
     * @param Comment $comment
     * @return Article
     */
    public function addComment(Comment $comment)
    {
        $this->comment[] = $comment;

        $comment->setArticle($this);

        return $this;
    }

    /**
     * Remove comment
     *
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return ArrayCollection
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
