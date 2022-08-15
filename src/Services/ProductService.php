<?php

namespace App\Services;


use App\Entity\Product;
use App\Message\NewProductMessage;
use App\Repository\ProductRepository;
use App\Requests\ProductRequest;
use Symfony\Component\Messenger\MessageBusInterface;

class ProductService
{
    public function __construct(
        private readonly ProductRepository   $repository,
        private readonly MessageBusInterface $bus)
    {
    }

    public function new(ProductRequest $validatedRequest): Product
    {
        $product = new Product();
        $product->setTitle($validatedRequest->title);
        $product->setStock($validatedRequest->stock);

        $this->repository->add($product, true);

        $this->bus->dispatch(new NewProductMessage($product->getId()));

        return $product;
    }
}