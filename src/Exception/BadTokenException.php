<?php

namespace AristekSystems\TestTask\Exception;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class BadTokenException extends Exception
{
    public const MESSAGE = 'Bad token';
    public const CODE = 403;

    /**
     * @param ConstraintViolationListInterface $violations
     */
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE, null);
    }
}
