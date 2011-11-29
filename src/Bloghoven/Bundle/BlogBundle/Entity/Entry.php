<?php

namespace Bloghoven\Bundle\BlogBundle\Entity;

/**
 * Bloghoven\Bundle\BlogBundle\Entity\Entry
 */
class Entry
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $excerpt
     */
    private $excerpt;

    /**
     * @var string $content
     */
    private $content;

    /**
     * @var DateTime $posted_at
     */
    private $posted_at;

    /**
     * @var DateTime $modified_at
     */
    private $modified_at;

    /**
     * @var boolean $is_draft
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
     * @param DateTime $postedAt
     */
    public function setPostedAt(\DateTime $postedAt)
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
    public function setModifiedAt(\DateTime $modifiedAt)
    {
        $this->modified_at = $modifiedAt;
    }

    /**
     * Get modified_at
     *
     * @return DateTime 
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