<?php

namespace Bloghoven\Bundle\BlogBundle\Entity;

use Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces\ImmutableEntryInterface;

/**
 * Bloghoven\Bundle\BlogBundle\Entity\Entry
 */
class Entry implements ImmutableEntryInterface
{
    /**
     * @var mixed $id
     */
    private $id;

    /**
     * @var string $permalink_id
     */
    private $permalink_id;

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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPermalinkId($permalink_id)
    {
        $this->permalink_id = $permalink_id;
    }

    public function getPermalinkId()
    {
        if ($this->permalink_id != null)
        {
            return $this->permalink_id;            
        }
        return $this->getId();
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    public function getExcerpt()
    {
        return $this->excerpt;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setPostedAt(\DateTime $postedAt)
    {
        $this->posted_at = $postedAt;
    }

    public function getPostedAt()
    {
        return $this->posted_at;
    }

    public function setModifiedAt(\DateTime $modifiedAt)
    {
        $this->modified_at = $modifiedAt;
    }

    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    public function setIsDraft($isDraft)
    {
        $this->is_draft = $isDraft;
    }

    public function isDraft()
    {
        return $this->is_draft;
    }

    public function getCategories()
    {
        # code...
    }
}