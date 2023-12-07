<?php
namespace Models;

class Photo
{
    protected string $descriptions;
    protected string $name;
    protected string $url;
    //write a method to convert to data-time object when used
    protected string $publishedAt;
    protected float $basePrice;

    public function __construct(string $name, string $url, string $publishedAt, float $basePrice)
    {
        $this->name = $name;
        $this->url = $url;
        $this->publishedAt = $publishedAt;
        $this->basePrice = $basePrice;
    }


}