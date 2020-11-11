<?php
namespace app\core\response;

use app\core\entities\Product;

class ProductResponse
{
    public int $id;
    public string $name;
    public int $price;

    /**
     * @param Product $product
     * @return static
     */
    public static function fromProduct(Product $product): self
    {
        $dto = new ProductResponse();
        $dto->id = $product->id;
        $dto->name = $product->name;
        $dto->price = $product->price;

        return $dto;
    }
}