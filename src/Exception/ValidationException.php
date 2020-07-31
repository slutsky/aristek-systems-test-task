<?php

namespace AristekSystems\TestTask\Exception;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends Exception
{
    public const MESSAGE = 'Bad request';
    public const CODE = 403;

    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }

    /**
     * @param ConstraintViolationListInterface $violations
     */
    public function __construct(ConstraintViolationListInterface $violations)
    {
        parent::__construct(self::MESSAGE, self::CODE, null);

        $this->violations = $violations;
    }
}