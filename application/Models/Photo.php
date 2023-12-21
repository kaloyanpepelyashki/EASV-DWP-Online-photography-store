<?php
namespace Models;

class Photo
{
    public readonly int $id;
    public readonly string $description;
    public readonly string $name;
    public readonly string $url;
    //write a method to convert to data-time object when used
    public readonly string $publishedAt;
    public readonly string $basePrice;

    public readonly string $aspectRatio;

    public function __construct(int $id, string $name, string $description, string $url, string $publishedAt, float $basePrice, string $aspectRatio)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->publishedAt = $publishedAt;
        $this->basePrice = $basePrice;
        $this->description = $description;
        $this->aspectRatio = $aspectRatio;
    }


}