<?php
namespace Models;

use Models as M;

include_once(__DIR__ . '/Photo.php');

//This model represents the product object that is added to the shopping cart
class CartProduct
{
    public M\Photo $photo;
    private $frame;

    private $size;
    private $material;

    public int $quantity;

    public function __construct(M\Photo $photo)
    {
        $this->photo = $photo;
        $this->quantity = 1;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

}