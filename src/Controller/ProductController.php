<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('', name: 'app_product_new', methods: ['POST'])]
    public function new(Request $request, ProductRepository $repository)
    {
        $requestData = $request->toArray();
       $product = new Product();
       $product->setTitle($requestData['title']);
       $product->setStock($requestData['stock']);

       $repository->add($product, true);

       return $this->json($product);
    }
}
