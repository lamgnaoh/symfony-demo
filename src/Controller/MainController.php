<?php

namespace App\Controller;

use App\Controller\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        $numsProduct = count($products);

        return $this->render('main/homepage.html.twig', [
            '$numsProduct' => $numsProduct,
        ]);
    }
}
