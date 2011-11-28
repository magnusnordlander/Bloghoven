<?php

namespace Bloghoven\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bloghoven\Bundle\BlogBundle\Entity\Entry
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bloghoven\Bundle\BlogBundle\Entity\EntryRepository")
 */
class Entry
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $excerpt
     *
     * @ORM\Column(name="excerpt", type="string", length=4096)
     */
    private $excerpt;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var datetime $posted_at
     *
     * @ORM\Column(name="posted_at", type="datetime")
     */
    private $posted_at;

    /**
     * @var datetime $modified_at
     *
     * @ORM\Column(name="modified_at", type="datetime")
     */
    private $modified_at;

    /**
     * @var boolean $is_draft
     *
     * @ORM\Column(name="is_draft", type="boolean")
     */
    private $is_draft;


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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Set excerpt
     *
     * @param string $excerpt
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set posted_at
     *
     * @param datetime $postedAt
     */
    public function setPostedAt($postedAt)
    {
        $this->posted_at = $postedAt;
    }

    /**
     * Get posted_at
     *
     * @return datetime 
     */
    public function getPostedAt()
    {
        return $this->posted_at;
    }

    /**
     * Set modified_at
     *
     * @param datetime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modified_at = $modifiedAt;
    }

    /**
     * Get modified_at
     *
     * @return datetime 
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * Set is_draft
     *
     * @param boolean $isDraft
     */
    public function setIsDraft($isDraft)
    {
        $this->is_draft = $isDraft;
    }

    /**
     * Get is_draft
     *
     * @return boolean 
     */
    public function getIsDraft()
    {
        return $this->is_draft;
    }
}