<?php

namespace App\Controller;

use App\Controller\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductApiController extends AbstractController
{
    #[Route('api/v1/products')]
    public function getCollection(): Response
    {
        $products = [
            new Product(
                1,
                'Iphone 13',
                400,
                true,
                '2024-04-03T00:00:00+00:00',
                '2024-04-03T70:00:00+00:00'
            ),
            new Product(
                2,
                'Ipad gen 9',
                200,
                false,
                '2024-04-02T00:00:00+00:00',
                '2024-04-03T70:00:00+00:00'
            ),
            new Product(
                3,
                'Macbook Air Pro',
                1000,
                true,
                '2024-04-01T00:00:00+00:00',
                '2024-04-03T00:00:00+00:00'
            ),
            new Product(
                4,
                'Airpods',
                70,
                true,
                '2024-04-03T00:00:00+00:00',
                '2024-04-03T70:00:00+00:00'
            ),
        ];

        return $this->json($products);
    }
}
