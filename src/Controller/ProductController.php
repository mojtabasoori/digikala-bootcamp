<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Message\NewProductMessage;
use App\Repository\ProductRepository;
use App\Requests\ProductRequest;
use App\Services\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('', name: 'app_product_new', methods: ['POST'])]
    #[ParamConverter('validatedRequest', class: ProductRequest::class)]
    public function new(
        ProductRequest $validatedRequest,
        ProductService $productService
    )
    {
        $product = $productService->new($validatedRequest);

       return $this->json($product);
    }

    #[Route('', name: 'app_product_index', methods: ['GET'])]
    public function index( ProductRepository $repository)
    {
        $products = $repository->findAll();

        return $this->json($products);
    }
}
