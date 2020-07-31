<?php

namespace AristekSystems\TestTask\Dto;

class CreateProjectRequestDto
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var int|null
     */
    private $budget;

    /**
     * @var array|null
     */
    private $contacts;

    /**
     * @param string|null $name
     * @param string|null $code
     * @param string|null $url
     * @param integer|null $budget
     * @param array|null $contacts
     */
    public function __construct(
        ?string $name,
        ?string $code,
        ?string $url,
        ?int $budget,
        ?array $contacts
    ) {
        $this->name = $name;
        $this->code = $code;
        $this->url = $url;
        $this->budget = $budget;
        $this->contacts = $contacts;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getBudget(): ?string
    {
        return $this->budget;
    }

    /**
     * @return array|null
     */
    public function getContacts(): ?array
    {
        return $this->contacts;
    }
}
