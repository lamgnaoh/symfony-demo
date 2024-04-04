<?php

namespace App\Controller;

use App\Controller\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductApiController extends AbstractController
{
    #[Route('api/v1/products')]
    public function getCollection(ProductRepository $repository): Response
    {
        $products = $repository->findAll();

        return $this->json($products);
    }
}
