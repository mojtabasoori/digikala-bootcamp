<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Requests\ProductRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('', name: 'app_product_new', methods: ['POST'])]
    #[ParamConverter('productRequest', class: ProductRequest::class)]
    public function new(
        Request $request,
        ProductRepository $repository,
        ProductRequest $productRequest)
    {

dd($productRequest);

        $requestData = $request->toArray();
       $product = new Product();
       $product->setTitle($requestData['title']);
//       $product->setStock($requestData['stock']);

        $violations = $validator->validate($product);

//        dd($violations);

       $repository->add($product, true);

       return $this->json($product);
    }
}
