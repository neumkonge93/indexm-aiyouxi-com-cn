<?php

/**
 * Site metadata container with description generation.
 * Stores basic site information and provides a method
 * to produce a short, SEO-friendly description string.
 */
class SiteMeta
{
    /** @var string */
    private $siteName;

    /** @var string */
    private $siteUrl;

    /** @var string */
    private $siteDescription;

    /** @var array<string, string> */
    private $keywords;

    /** @var array<string, string> */
    private $extraMeta;

    /**
     * @param string $name
     * @param string $url
     * @param string $description
     * @param array<string, string> $keywords
     * @param array<string, string> $extraMeta
     */
    public function __construct(
        string $name,
        string $url,
        string $description = '',
        array $keywords = [],
        array $extraMeta = []
    ) {
        $this->siteName = $name;
        $this->siteUrl = $url;
        $this->siteDescription = $description;
        $this->keywords = $keywords;
        $this->extraMeta = $extraMeta;
    }

    /**
     * Get site name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->siteName;
    }

    /**
     * Get site URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * Get site description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->siteDescription;
    }

    /**
     * Get keywords as associative array.
     *
     * @return array<string, string>
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Get extra meta tags.
     *
     * @return array<string, string>
     */
    public function getExtraMeta(): array
    {
        return $this->extraMeta;
    }

    /**
     * Generate a short description text.
     * Combines site name, description, and up to 3 keywords.
     *
     * @return string
     */
    public function generateShortDescription(): string
    {
        $parts = [];

        if (!empty($this->siteName)) {
            $parts[] = $this->siteName;
        }

        if (!empty($this->siteDescription)) {
            $parts[] = $this->siteDescription;
        }

        $keywordValues = array_values($this->keywords);
        if (!empty($keywordValues)) {
            $selectedKeywords = array_slice($keywordValues, 0, 3);
            $parts[] = implode(', ', $selectedKeywords);
        }

        return implode(' - ', $parts);
    }

    /**
     * Convert object to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->siteName,
            'url' => $this->siteUrl,
            'description' => $this->siteDescription,
            'keywords' => $this->keywords,
            'extra' => $this->extraMeta,
        ];
    }
}

// Example usage

$meta = new SiteMeta(
    '爱游戏',
    'https://indexm-aiyouxi.com.cn',
    '专业游戏资讯与社区平台',
    [
        'kw1' => '爱游戏',
        'kw2' => '游戏资讯',
        'kw3 => '玩家社区',
        'kw4' => '游戏评测',
        'kw5' => '攻略分享',
    ],
    [
        'author' => 'Admin',
        'viewport' => 'width=device-width, initial-scale=1.0',
    ]
);

echo $meta->generateShortDescription() . PHP_EOL;