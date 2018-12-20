<?php
declare(strict_types=1);

namespace Marcel\Domain;

class Blog
{
    /** @var string */
    private $title;

    /** @var string */
    private $introductionText;

    /** @var string */
    private $content;

    /** @var string */
    private $imageUrl;

    /** @var int */
    private $id;

    /**
     * @param string $title
     * @param string $introductionText
     * @param string $content
     */
    public function __construct(int $id, string $title, string $introductionText, string $content)
    {
        if (empty($title)) {
            throw new InvalidArgumentException('Blog title is empty');
        }

        if (empty($introductionText)) {
            throw new InvalidArgumentException('Blog intro is empty');
        }

        if (empty($content)) {
            throw new InvalidArgumentException('Blog content is empty');
        }

        $this->title = $title;
        $this->introductionText = $introductionText;
        $this->content = $content;
        $this->id = $id;
    }

    /**
     * @param string $imageUrl
     * @return Blog
     */
    public function withImage(string $imageUrl): self
    {
        $blog = clone $this;
        $blog->imageUrl = $imageUrl;

        return $blog;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setImageUrl(string $value)
    {
        $this->imageUrl = $value;
    }

    /**
     * @return string
     */
    public function getIntroductionText(): string
    {
        return $this->introductionText;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
}
