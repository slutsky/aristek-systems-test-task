<?php

namespace AristekSystems\TestTask\Dto;

class CreateContactRequestDto
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $phone;

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $phone
     */
    public function __construct(
        ?string $firstName,
        ?string $lastName,
        ?string $phone
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
