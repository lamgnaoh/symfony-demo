<?php

namespace App\Controller;

use App\Controller\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/v1/products')]
class ProductApiController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getCollection(ProductRepository $repository): Response
    {
        $products = $repository->findAll();

        return $this->json($products);
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function getItem(int $id, ProductRepository $repository): Response
    {
        $product = $repository->find($id);

        if (null === $product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->json($product);
    }
}
