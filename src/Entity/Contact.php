<?php

namespace AristekSystems\TestTask\Entity;

class Contact
{
    /**
     * @var ContactId
     */
    private $id;

    /**
     * string 50
     *
     * @var string
     */
    private $firstName;

    /**
     * string 50
     *
     * @var string
     */
    private $lastName;

    /**
     * mask +xxx (xx) xxx-xx-xx
     *
     * @var string
     */
    private $phone;

    /**
     * @return ContactId
     */
    public function getId(): ContactId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $phone
     */
    public function __construct(string $firstName, string $lastName, string $phone)
    {
        $this->id = new ContactId();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
    }
}