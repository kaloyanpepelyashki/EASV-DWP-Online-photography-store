<?php


class PhotoModel
{
    public string $descriptions;
    public string $name;
    public string $url;
    //write a method to convert to data-time object when used
    public string $publishedAt;
    public float $basePrice;

    public function __construct(string $name, string $url, string $publishedAt, float $basePrice)
    {
        $this->name = $name;
        $this->url = $url;
        $this->publishedAt = $publishedAt;
        $this->basePrice = $basePrice;
    }




}