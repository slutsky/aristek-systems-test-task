<?php

namespace AristekSystems\TestTask\Entity;

class ContactId
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @param int|null $id
     */
    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function toValue(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }
}
