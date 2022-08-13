<?php

namespace App\Requests;

use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseValidateRequest
{
    public function __construct(array $fields, ValidatorInterface $validator)
    {
        $this->init($fields);
        $this->validate($validator);
    }

    private function validate(ValidatorInterface $validator) {
        $errors = $validator->validate($this);

        if ($errors->count()) {
            throw new \Exception();
        }

    }

    abstract protected function init(array $fields): void;
}