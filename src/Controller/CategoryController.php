<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/category')]
class CategoryController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function get(Request $request, CategoryRepository $repository): Response
    {
        //        dd($request);
        $name = $request->query->get('name');
        if (null == $name) {
            $categories = $repository->findAll();
        } else {
            $categories = $repository->findByName($name);
        }

        $context = [AbstractNormalizer::ATTRIBUTES => ['id', 'text' => 'name']];

        return $this->json($categories, 200, [], $context);
    }
}
