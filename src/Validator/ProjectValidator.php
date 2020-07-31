<?php

namespace AristekSystems\TestTask\Validator;

use AristekSystems\TestTask\Dto\CreateProjectRequestDto;
use AristekSystems\TestTask\Dto\RenameProjectRequestDto;
use AristekSystems\TestTask\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectValidator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param CreateProjectRequestDto $createProjectRequestDto
     * @throws ValidationException
     */
    public function validateCreateProjectRequest(CreateProjectRequestDto $createProjectRequestDto): void
    {
        $errors = $this->validator->validate($createProjectRequestDto);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

    /**
     * @param RenameProjectRequestDto $renameProjectRequestDto
     * @throws ValidationException
     */
    public function validateRenameProjectRequest(RenameProjectRequestDto $renameProjectRequestDto): void
    {
        
        $errors = $this->validator->validate($renameProjectRequestDto);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}