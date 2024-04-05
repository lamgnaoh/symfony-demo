<?php

namespace App\Controller;

use App\Controller\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/{id<\d+>}', name: 'app_product_product_detail', methods: ['GET'])]
    public function get(int $id, ProductRepository $repository): Response
    {
        $product = $repository->find($id);
        if (null == $product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('product/product-detail.html.twig', [
            'product' => $product,
        ]);
    }
}
