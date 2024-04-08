<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductForm;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    #[Route('/edit', name: 'app_product_edit', methods: ['POST', 'PUT'])]
    public function edit(Request $request, ProductRepository $repository): ?Response
    {
        //        dd($request);
        $productId = $request->request->get('id');
        $product = $repository->find($productId);
        if (null == $product) {
            $this->addFlash('error', ['Product not found']);

            return $this->redirectToRoute('app_main_homepage');
        }
        $productForm = $this->createForm(ProductForm::class);
        $productForm->handleRequest($request);
        $formData = $productForm->getData();
        $product->setName($formData->getName());
        $product->setPrice($formData->getPrice());
        $product->setUpdatedAt(new \DateTimeImmutable());
        $repository->save($product);
        $this->addFlash('success', ['Product updated successfully']);

        return $this->redirectToRoute('app_main_homepage');
    }

    #[Route('/create', name: 'app_product_form', methods: ['GET'])]
    public function create(Request $request, ProductRepository $repository): Response
    {
        //        creat a form
        if ($request->query->get('id')) {
            $productId = $request->query->get('id');
            $product = $repository->find($productId);
            if (null == $product) {
                $this->addFlash('error', ['Product not found']);

                return $this->redirectToRoute('app_main_homepage');
            }
            $productForm = $this->createForm(ProductForm::class, null, [
                'action' => $this->generateUrl('app_product_edit'),
                'method' => 'PUT',
            ]);

            $productForm->setData($product);

            return $this->render('product/product_create.html.twig',
                ['productForm' => $productForm->createView()]
            );
        }
        $productForm = $this->createForm(ProductForm::class);

        return $this->render('product/product_create.html.twig',
            ['productForm' => $productForm->createView()]
        );
    }

    #[Route('/create', name: 'app_product_create', methods: ['POST'])]
    public function insertProducts(
        Request $request,
        ProductRepository $repository,
        ValidatorInterface $validator): Response
    {
        $productForm = $this->createForm(ProductForm::class);
        $productForm->handleRequest($request);
        $product = $productForm->getData();
        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            $this->addFlash('error', $errorMessages);

            return $this->redirectToRoute('app_main_homepage');
        }
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = $productForm->getData();
            $repository->save($product);
            $this->addFlash('success', ['Product created successfully']);

            return $this->redirectToRoute('app_main_homepage');
        }

        return $this->redirectToRoute('app_main_homepage');
    }

    #[Route('/delete/{id}', name: 'app_product_delete', methods: ['DELETE'])]
    //    fetch automatically the product from the database
    public function delete(Product $product, ProductRepository $repository): ?Response
    {
        $repository->delete($product);
        $this->addFlash('success', ['Product delete successfully']);
        return $this->redirectToRoute('app_main_homepage');
    }
}
