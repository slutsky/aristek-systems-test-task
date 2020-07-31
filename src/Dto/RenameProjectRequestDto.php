<?php

namespace AristekSystems\TestTask\Dto;

use AristekSystems\TestTask\Entity\ProjectId;

class RenameProjectRequestDto
{
    /**
     * @var ProjectId
     */
    private $projectId;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param ProjectId $projectId
     * @param string|null $name
     */
    public function __construct(ProjectId $projectId, ?string $name)
    {
        $this->projectId = $projectId;
        $this->name = $name;
    }

    /**
     * @return ProjectId
     */
    public function getProjectId(): ProjectId
    {
        return $this->projectId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
