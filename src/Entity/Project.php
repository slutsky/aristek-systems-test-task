<?php

namespace AristekSystems\TestTask\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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
     * @var ArrayCollection<Contact>
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
     * @return int
     */
    public function getBudget(): int
    {
        return $this->budget;
    }

    /**
     * @return Contact[]
     */
    public function getContacts(): array
    {
        return $this->contacts->toArray();
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $url
     * @param string $budget
     */
    public function __construct(
        string $name,
        string $code,
        string $url,
        string $budget
    ) {
        $this->id = new ProjectId();
        $this->name = $name;
        $this->code = $code;
        $this->url = $url;
        $this->budget = $budget;
        $this->contacts = new ArrayCollection();
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $phone
     * @return Contact
     */
    public function createContact(
        string $firstName,
        string $lastName,
        string $phone
    ): Contact {
        $contact = new Contact(
            $this,
            $firstName,
            $lastName,
            $phone
        );

        $this->contacts->add($contact);

        return $contact;
    }

    /**
     * @param string $name
     */
    public function rename(string $name): void
    {
        $this->name = $name;
    }
}
