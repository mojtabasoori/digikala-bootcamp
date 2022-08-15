<?php

namespace App\EntityListeners;

use App\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductEntityListener
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function prePersist(Product $product,LifecycleEventArgs $eventArgs): void
    {
        $product->generateSlug($this->slugger);
    }

    public function preUpdate(Product $product,LifecycleEventArgs $eventArgs): void
    {
        $product->generateSlug($this->slugger);
    }
}