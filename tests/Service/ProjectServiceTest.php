<?php

namespace AristekSystems\TestTask\Tests\Service;

use AristekSystems\TestTask\Dto\CreateContactRequestDto;
use AristekSystems\TestTask\Dto\CreateProjectRequestDto;
use AristekSystems\TestTask\Dto\RenameProjectRequestDto;
use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use AristekSystems\TestTask\Repository\ProjectInMemoryRepository;
use AristekSystems\TestTask\Repository\ProjectRepositoryInterface;
use AristekSystems\TestTask\Service\ProjectService;
use AristekSystems\TestTask\Validator\ProjectValidator;
use PHPUnit\Framework\TestCase;

class ProjectServiceTest extends TestCase
{
    /**
     * @param ProjectId $projectId
     * @return Project
     */
    private function createProjectStub(ProjectId $projectId): Project
    {
        $project = $this->createStub(Project::class);
        $project->method('getId')->willReturn($projectId);

        /** @var Project $project */
        return $project;
    }

    public function testGetProjects(): void
    {
        $expectedProject = $this->createProjectStub(new ProjectId(1));
        $projectRepository = new ProjectInMemoryRepository();
        $projectRepository->addProject($expectedProject);

        $projectValidator = $this->createMock(ProjectValidator::class);
        /** @var ProjectValidator $projectValidator */

        $projectService = new ProjectService($projectRepository, $projectValidator);
        
        $projects = $projectService->getProjects();
        $this->assertCount(1, $projects);

        $project = $projects[0];
        $this->assertEquals($expectedProject, $project);
    }

    public function testGetProject(): void
    {
        $expectedProject =  $this->createProjectStub(new ProjectId(2));
        $projectRepository = new ProjectInMemoryRepository();
        $projectRepository->addProject($this->createProjectStub(new ProjectId(1)));
        $projectRepository->addProject($expectedProject);
        $projectRepository->addProject($this->createProjectStub(new ProjectId(3)));
        $projectValidator = $this->createMock(ProjectValidator::class);
        /** @var ProjectValidator $projectValidator */

        $projectService = new ProjectService($projectRepository, $projectValidator);
        
        $project = $projectService->getProject(new ProjectId(2));
        $this->assertEquals($expectedProject, $project);
    }

    public function testCreateProject(): void
    {
        $expectedName = 'Project';
        $expectedCode = 'np';
        $expectedUrl = 'http://example.com/new-page';
        $expectedBudget = 100;
        $expectedContactFirstName = 'Jon';
        $expectedContactLastName = 'Doe';
        $expectedContactPhone = '+012 (34) 567-89-10';

        $projectValidator = $this->createMock(ProjectValidator::class);
        $projectValidator->expects($this->once())->method('validateCreateProjectRequest');
        /** @var ProjectValidator $projectValidator */

        $projectRepository = $this->createMock(ProjectRepositoryInterface::class);
        $projectRepository->expects($this->once())->method('addProject');
        /** @var ProjectRepositoryInterface $projectRepository */

        $projectService = new ProjectService($projectRepository, $projectValidator);

        $project = $projectService->createProject(
            new CreateProjectRequestDto(
                $expectedName,
                $expectedCode,
                $expectedUrl,
                $expectedBudget,
                [ 
                    new CreateContactRequestDto(
                        $expectedContactFirstName,
                        $expectedContactLastName,
                        $expectedContactPhone
                    )
                ]
            )
        );

        $this->assertEquals($expectedName, $project->getName());
        $this->assertEquals($expectedCode, $project->getCode());
        $this->assertEquals($expectedUrl, $project->getUrl());
        $this->assertEquals($expectedBudget, $project->getBudget());

        $contacts = $project->getContacts();
        $this->assertCount(1, $contacts);

        $contact = $contacts[0];
        $this->assertEquals($expectedContactFirstName, $contact->getFirstName());
        $this->assertEquals($expectedContactLastName, $contact->getLastName());
        $this->assertEquals($expectedContactPhone, $contact->getPhone());
    }

    public function testDeleteProject(): void
    {
        $projectRepository = $this->createMock(ProjectRepositoryInterface::class);
        $projectRepository->expects($this->once())->method('removeProject');
        /** @var ProjectRepositoryInterface $projectRepository */

        $projectValidator = $this->createMock(ProjectValidator::class);
        /** @var ProjectValidator $projectValidator */

        $projectService = new ProjectService($projectRepository, $projectValidator);

        $projectService->deleteProject(new ProjectId(1));
    }

    public function testRenameProject(): void
    {
        $project = $this->createMock(Project::class);
        $project->method('getId')->willReturn(new ProjectId(1));
        $project->expects($this->once())->method('rename');
        /** @var Project $project */

        $projectRepository = new ProjectInMemoryRepository();
        $projectRepository->addProject($project);

        $projectValidator = $this->createMock(ProjectValidator::class);
        $projectValidator->expects($this->once())->method('validateRenameProjectRequest');
        /** @var ProjectValidator $projectValidator */

        $projectService = new ProjectService($projectRepository, $projectValidator);

        $projectService->renameProject(
            new RenameProjectRequestDto(new ProjectId(1), 'New name')
        );
    }
}