<?php
namespace App\MessageHandler;


use App\Message\NewProductMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class NewProductHandler
{
    public function __invoke(NewProductMessage $event)
    {
        echo $event->id;
    }
}