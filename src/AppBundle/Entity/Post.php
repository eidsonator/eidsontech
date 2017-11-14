<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Util\Markdown;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="simple_array", nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="markdown", type="text")
     */
    private $markdown;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published", type="date")
     */
    private $published;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="text")
     */
    private $slug;

    /**
     * @var array
     *
     * @ORM\Column(name="keywords", type="simple_array", nullable=true)
     */
    private $keywords;

    public function __construct()
    {
        $this->setPublished(new \DateTime('now'));
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Post
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
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
     * Set image
     *
     * @param string $image
     *
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set tags
     *
     * @param array $tags
     *
     * @return Post
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set markdown
     *
     * @param string $markdown
     *
     * @return Post
     */
    public function setMarkdown($markdown)
    {
        $this->markdown = $markdown;

        return $this;
    }

    /**
     * Get markdown
     *
     * @return string
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Post
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set keywords
     *
     * @param array $keywords
     *
     * @return Post
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getHtml()
    {
        return Markdown::toHtml($this->getMarkdown());
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        $lines = explode(PHP_EOL, $this->getMarkdown());
        $md = '';
        $count = count($lines);
        $end = $count > 10 ? 10 : $count - 1;
        for ($i = 0; $i <= $end; $i++) {
            $md .= $lines[$i];
        }
        return Markdown::toHtml($md);
    }
}

