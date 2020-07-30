<?php

namespace AristekSystems\TestTask\Entity;

class ProjectId
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
     * @param ProjectId $another
     * @return bool
     */
    public function equals(ProjectId $another): bool
    {
        if ($another === $this) {
            return true;
        }

        if ($this->id === null || $another->id === null) {
            return false;
        }

        return $this->id === $another->id;
    }
}