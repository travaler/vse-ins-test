<?php
namespace app\core\repositories;

use app\core\entities\Product;
use app\core\response\ProductResponse;

class ProductArRepository implements ProductRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByIds(array $ids): array
    {
        return Product::find()
            ->where(['id' => $ids])
            ->all();
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $products = Product::find()
            ->all();

        return array_map(function (Product $product) {
            return ProductResponse::fromProduct($product);
        }, $products);
    }
}