<?php

namespace AristekSystems\TestTask\Repository;

use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use AristekSystems\TestTask\Exception\ProjectNotFoundException;

class ProjectInMemoryRepository implements ProjectRepositoryInterface
{
    /**
     * @var Project[]
     */
    private $projects;

    /**
     * @param Project[] $projects
     */
    public function __construct(array $projects)
    {
        $this->projects = $projects;
    }

    /**
     * @return Project[]
     */
    public function getProjects(): array
    {
        return $this->projects;
    }

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     * @return Project
     */
    public function getProject(ProjectId $projectId): Project
    {
        foreach ($this->projects as $project) {
            if ($project->getId()->equals($projectId)) {
                return $project;
            }
        }

        throw new ProjectNotFoundException();
    }

    /**
     * @param Project $project
     */
    public function addProject(Project $project): void
    {
        try {
            $this->getProject($project->getId());
        } catch (ProjectNotFoundException $exception) {
            $this->projects[] = $project;
        }
    }

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     */
    public function removeProject(ProjectId $projectId): void
    {
        $filteredProjects = [];
        $isProjectNotFound = true;
        foreach ($this->projects as $project) {
            if ($project->getId()->equals($projectId)) {
                $isProjectNotFound = false;
            } else {
                $filteredProjects[] = $project;
            }
        }

        if ($isProjectNotFound) {
            throw new ProjectNotFoundException();
        }

        $this->projects = $filteredProjects;
    }
}
