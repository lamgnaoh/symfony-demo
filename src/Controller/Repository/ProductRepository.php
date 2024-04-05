<?php

namespace App\Controller\Repository;

use App\Controller\Model\Product;
use Psr\Log\LoggerInterface;

class ProductRepository
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAll(): array
    {
        $this->logger->info('Fetching products from database');

        return [
            new Product(1, 'Iphone 13', 400, true, '2024-04-03T00:00:00+00:00', '2024-04-03T70:00:00+00:00'),
            new Product(2, 'Ipad gen 9', 200, false, '2024-04-02T00:00:00+00:00', '2024-04-03T70:00:00+00:00'),
            new Product(3, 'Macbook Air Pro', 1000, true, '2024-04-01T00:00:00+00:00', '2024-04-03T00:00:00+00:00'),
            new Product(4, 'Airpods', 70, true, '2024-04-03T00:00:00+00:00', '2024-04-03T70:00:00+00:00'),
        ];
    }

    public function find(int $id): ?Product
    {
        $this->logger->info('Fetching product from database', ['id' => $id]);

        $products = $this->findAll();

        foreach ($products as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }

        return null;
    }
}
