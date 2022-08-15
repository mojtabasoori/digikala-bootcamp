<?php

namespace App\Message;

class NewProductMessage
{
    public function __construct(public readonly int $id)
    {
    }
}