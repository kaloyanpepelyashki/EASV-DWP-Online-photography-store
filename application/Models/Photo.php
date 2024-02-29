<?php
namespace Models;

class Photo
{
    /**
     * @var int The ID of the photo.
     */
    public readonly int $id;

    /**
     * @var string The description of the photo.
     */
    public readonly string $description;

    /**
     * @var string The name of the photo.
     */
    public readonly string $name;

    /**
     * @var string The URL of the photo.
     */
    public readonly string $url;

    /**
     * @var string The published date of the photo.
     */
    public readonly string $publishedAt;

    /**
     * @var float The base price of the photo.
     */
    public readonly string $basePrice;

    /**
     * @var string The aspect ratio of the photo.
     */
    public readonly string $aspectRatio;

    /**
     * Photo constructor.
     *
     * @param int $id The ID of the photo.
     * @param string $name The name of the photo.
     * @param string $description The description of the photo.
     * @param string $url The URL of the photo.
     * @param string $publishedAt The published date of the photo.
     * @param float $basePrice The base price of the photo.
     * @param string $aspectRatio The aspect ratio of the photo.
     */
    public function __construct(int $id, string $name, string $description, string $url, string $publishedAt, float $basePrice, string $aspectRatio)
    {
        // Initialize properties with provided values
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->publishedAt = $publishedAt;
        $this->basePrice = $basePrice;
        $this->description = $description;
        $this->aspectRatio = $aspectRatio;
    }
}
