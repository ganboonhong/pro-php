<?php declare (strict_type = 1);

namespace SocialNews\FrontPage\Application;

/**
 * Submission class
 */
final class Submission
{
    private $url;
    private $title;

    public function __construct(string $url, string $title)
    {
        $this->url = $url;
        $this->title = $title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
