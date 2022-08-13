<?php

namespace App\Requests;

trait ValidateRequestTrait
{
    protected function init(array $fields): void
    {
        foreach ($fields as $field => $value) {
            if (property_exists($this, $field)) {
                $this->{$field} = $value;
            }
        }
    }
}