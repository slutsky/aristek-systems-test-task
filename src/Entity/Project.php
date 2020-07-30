<?php

namespace AristekSystems\TestTask\Entity;

class Project
{
    /**
     * @var ProjectId
     */
    private $id;

    /**
     * string 50 only space and latin letters in any case, min length - 5
     *
     * @var string
     */
    private $name;

    /**
     * string 10 only latin letters in lower case, min length - 3, can not be changed
     *
     * @var string
     */
    private $code;

    /**
     * only valid urls from domain example.com
     *
     * @var string
     */
    private $url;

    /**
     * BYN amount
     *
     * @var int
     */
    private $budget;

    /**
     * @var Contact[]
     */
    private $contacts;

    /**
     * @return ProjectId
     */
    public function getId(): ProjectId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getBudget(): string
    {
        return $this->budget;
    }

    /**
     * @return Contact[]
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $url
     * @param string $budget
     * @param Contact[] $contacts
     */
    public function __construct(
        string $name,
        string $code,
        string $url,
        string $budget,
        array $contacts
    ) {
        $this->id = new ProjectId();
        $this->name = $name;
        $this->code = $code;
        $this->url = $url;
        $this->budget = $budget;
        $this->contacts = $contacts;
    }

    /**
     * @param string $name
     */
    public function rename(string $name): void
    {
        $this->name = $name;
    }
}