<?php

namespace App\Controller;

use App\Controller\Model\ProductDTO;
use App\Controller\Repository\ProductRepository;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
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
    #[Route('', name: 'app_product_create', methods: ['POST'])]
    public function insertProducts(
        #[MapRequestPayload] ProductDTO $productDTO,
        EntityManagerInterface $entity_manager): Response
    {
        $product = new Product();
        $product->setName($productDTO->getName());
        $product->setPrice($productDTO->getPrice());
        $product->setInStock(true);

        //        tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entity_manager->persist($product);

        //        actually executes the queries (i.e. the INSERT query)
        $entity_manager->flush();

        return $this->redirectToRoute('app_main_homepage');
    }
}
