<?php
namespace app\core\repositories;

use app\core\dto\ProductDto;
use app\core\entities\Product;

interface ProductRepositoryInterface
{
    /**
     * @param array $ids
     * @return Product[]
     */
    public function findByIds(array $ids): array;

    /**
     * @return ProductDto[]
     */
    public function all(): array;
}