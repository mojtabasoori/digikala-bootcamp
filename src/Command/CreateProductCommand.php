<?php

namespace App\Command;

use App\Requests\ProductRequest;
use App\Services\ProductService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(name: "app:create-product", description: "create a new product")]
class CreateProductCommand extends Command
{
    protected static $defaultName = "app:create-product";

    public function __construct(readonly private ProductService $productService, readonly private ValidatorInterface $validator)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('title', InputArgument::REQUIRED);
        $this->addArgument('stock', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $request = new ProductRequest( $input->getArguments(), $this->validator);

        $output->writeln(array_keys($input->getArguments()));
        $product = $this->productService->new($request);

        $output->writeln($product->getId());

        return self::SUCCESS;
    }
}