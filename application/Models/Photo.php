<?php
namespace Models;

class Photo
{
    public readonly string $description;
    public readonly string $name;
    public readonly string $url;
    //write a method to convert to data-time object when used
    public readonly string $publishedAt;
    public readonly string $basePrice;

    public function __construct(string $name, string $description, string $url, string $publishedAt, float $basePrice)
    {
        $this->name = $name;
        $this->url = $url;
        $this->publishedAt = $publishedAt;
        $this->basePrice = $basePrice;
        $this->description = $description;
    }


}