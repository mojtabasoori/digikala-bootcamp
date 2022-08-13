<?php

namespace App\Requests;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidateRequest implements ParamConverterInterface
{

    public function __construct(private readonly ValidatorInterface $validator,)
    {
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $className = $configuration->getClass();
        $validatedRequest = new $className($request->toArray(), $this->validator);

        $request->attributes->set('validatedRequest', $validatedRequest);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return is_subclass_of($configuration->getClass(), BaseValidateRequest::class);
    }
}