<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class JsonToArrayTransformer implements DataTransformerInterface
{
    public function transform($value): array
    {
        if (null === $value) {
            return [];
        }

        if (!is_array($value)) {
            throw new TransformationFailedException('Expected an array.');
        }

        return $value;
    }

    public function reverseTransform($value): array
    {
        if (empty($value)) {
            return [];
        }

        if (!is_array($value)) {
            throw new TransformationFailedException('Expected an array.');
        }

        return $value;
    }
}
