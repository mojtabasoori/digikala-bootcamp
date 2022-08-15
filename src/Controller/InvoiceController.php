<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class InvoiceController extends AbstractController
{
    #[Route("/invoice", methods: ['POST'])]
    public function new(Request $request, InvoiceRepository $invoiceRepository, ProductRepository $productRepository)
    {
        $requestBody = $request->toArray();

        $productsIds = array_reduce($requestBody["items"], function($ax, $a) {
             $ax[] = $a['product_id'];
             return $ax;
             }, []);

        $products = $productRepository->findByIds($productsIds);

        $invoice = new Invoice();
        foreach ($products as $product) {
            $invoice->addProduct($product);
        }


//        dd($serializer->serialize($invoice, 'json', ['groups' => ['invoice', 'product']]));

        $invoiceRepository->add($invoice, true);
        return $this->json($invoice, context: ['groups' => ['t', 'product']]);
    }
}