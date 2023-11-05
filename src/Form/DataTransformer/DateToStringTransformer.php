<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a date string (Y-m-d) to a DateTime object.
     *
     * @param  string|null $dateString
     * @return \DateTime|null
     * @throws TransformationFailedException if the date string is invalid
     */
    public function reverseTransform($dateString)
    {
        if (!$dateString) {
            return null;
        }

        $date = \DateTime::createFromFormat('Y-m-d', $dateString);

        if (!$date) {
            throw new TransformationFailedException(sprintf(
                'Invalid date format. Expected Y-m-d, but got %s',
                $dateString
            ));
        }

        return $date;
    }

    /**
     * Transforms a DateTime object to a date string (Y-m-d).
     *
     * @param  \DateTime|null $date
     * @return string|null
     */
    public function transform($date)
    {
        if (!$date) {
            return null;
        }

        return $date->format('Y-m-d');
    }
}
