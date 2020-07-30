<?php

namespace AristekSystems\TestTask\Repository;

use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;

interface ProjectRepositoryInterface
{
    /**
     * @return Project[]
     */
    public function getProjects(): array;

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     * @return Project
     */
    public function getProject(ProjectId $projectId): Project;

    /**
     * @param Project $project
     */
    public function addProject(Project $project): void;

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     */
    public function removeProject(ProjectId $projectId): void;
}