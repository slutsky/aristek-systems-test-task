<?php

namespace AristekSystems\TestTask\Tests\Repository;

use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use AristekSystems\TestTask\Exception\ProjectNotFoundException;
use AristekSystems\TestTask\Repository\ProjectInMemoryRepository;
use PHPUnit\Framework\TestCase;

class ProjectInMemoryRepositoryTest extends TestCase
{
    /**
     * @param ProjectId $projectId
     * @return Project
     */
    private function createProjectStub(ProjectId $projectId): Project
    {
        $expectedProject = $this->createStub(Project::class);
        $expectedProject->method('getId')->willReturn($projectId);

        return $expectedProject;
    }

    public function testGetProjects(): void
    {
        $expectedProject = $this->createProjectStub(new ProjectId(1));

        $projectRepository = new ProjectInMemoryRepository([$expectedProject]);
        $projects = $projectRepository->getProjects();

        $this->assertCount(1, $projects);

        $project = $projects[0];
        $this->assertEquals($expectedProject, $project);
    }

    public function testGetProject(): void
    {
        $expectedProject = $this->createProjectStub(new ProjectId(2));

        $projectRepository = new ProjectInMemoryRepository([
            $this->createProjectStub(new ProjectId(1)),
            $expectedProject,
            $this->createProjectStub(new ProjectId(3))
        ]);

        $project = $projectRepository->getProject(new ProjectId(2));
        $this->assertEquals($expectedProject, $project);
    }

    public function testAddProject(): void
    {
        $expectedProject = $this->createProjectStub(new ProjectId(2));

        $projectRepository = new ProjectInMemoryRepository([
            $this->createProjectStub(new ProjectId(1)),
            $this->createProjectStub(new ProjectId(3))
        ]);

        $projectRepository->addProject($expectedProject);

        $project = $projectRepository->getProject(new ProjectId(2));
        $this->assertEquals($expectedProject, $project);
    }

    public function testRemoveProject(): void
    {
        $projectRepository = new ProjectInMemoryRepository([
            $this->createProjectStub(new ProjectId(1)),
            $this->createProjectStub(new ProjectId(2)),
            $this->createProjectStub(new ProjectId(3))
        ]);

        $projectRepository->removeProject(new ProjectId(2));

        $this->expectException(ProjectNotFoundException::class);
        $projectRepository->getProject(new ProjectId(2));
    }
}
