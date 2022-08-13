<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class ProductRequest extends BaseValidateRequest
{
    use ValidateRequestTrait;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(min: 4, max: 255)]
    public readonly ?string $title;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public readonly ?int $stock;
}
