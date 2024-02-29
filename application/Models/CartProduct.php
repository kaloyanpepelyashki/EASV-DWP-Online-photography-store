<?php
namespace Models;

use Models as M;

// Include_once statement to include the Photo model
include_once(__DIR__ . '/Photo.php');

/**
 * This model represents the product object that is added to the shopping cart.
 */
class CartProduct
{
    /**
     * The photo associated with the cart product.
     *
     * @var M\Photo
     */
    public M\Photo $photo;

    /**
     * The frame of the cart product.
     *
     * @var mixed
     */
    private $frame;

    /**
     * The size of the cart product.
     *
     * @var mixed
     */
    private $size;

    /**
     * The material of the cart product.
     *
     * @var mixed
     */
    private $material;

    /**
     * The quantity of the cart product.
     *
     * @var int
     */
    public int $quantity;

    /**
     * Constructs a new CartProduct instance.
     *
     * @param M\Photo $photo The photo to associate with the cart product.
     */
    public function __construct(M\Photo $photo)
    {
        // Assign the provided Photo object to the $this->photo property
        $this->photo = $photo;
        
        // Set the quantity to 1 by default
        $this->quantity = 1;
    }

    /**
     * Get the photo associated with the cart product.
     *
     * @return M\Photo The photo associated with the cart product.
     */
    public function getPhoto()
    {
        // Return the associated Photo object
        return $this->photo;
    }
}
