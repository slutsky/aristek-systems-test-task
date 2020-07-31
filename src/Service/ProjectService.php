<?php

namespace AristekSystems\TestTask\Service;

use AristekSystems\TestTask\Dto\CreateContactRequestDto;
use AristekSystems\TestTask\Dto\CreateProjectRequestDto;
use AristekSystems\TestTask\Dto\RenameProjectRequestDto;
use AristekSystems\TestTask\Entity\Contact;
use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use AristekSystems\TestTask\Exception\ProjectNotFoundException;
use AristekSystems\TestTask\Exception\ValidationException;
use AristekSystems\TestTask\Repository\ProjectRepositoryInterface;
use AristekSystems\TestTask\Validator\ProjectValidator;

class ProjectService
{
    /** @var ProjectRepositoryInterface */
    private $projectRepository;

    /** @var ProjectValidator */
    private $projectValidator;

    /**
     * @param ProjectRepositoryInterface $projectRepository
     * @param ProjectValidator $projectValidator
     */
    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectValidator $projectValidator
    ) {
        $this->projectRepository = $projectRepository;
        $this->projectValidator = $projectValidator;
    }

    /**
     * @return Project[]
     */
    public function getProjects(): array
    {
        return $this->projectRepository->getProjects();
    }

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     * @return Project
     */
    public function getProject(ProjectId $projectId): Project
    {
        return $this->projectRepository->getProject($projectId);
    }

    /**
     * @param CreateProjectRequestDto $createProjectRequest
     * @throws ValidationException
     * @return Project
     */
    public function createProject(CreateProjectRequestDto $createProjectRequest): Project
    {
        $this->projectValidator->validateCreateProjectRequest($createProjectRequest);

        $project = new Project(
            $createProjectRequest->getName(),
            $createProjectRequest->getCode(),
            $createProjectRequest->getUrl(),
            $createProjectRequest->getBudget()
        );

        foreach ($createProjectRequest->getContacts() as $createContactRequestDto) {
            $project->createContact(
                $createContactRequestDto->getFirstName(),
                $createContactRequestDto->getLastName(),
                $createContactRequestDto->getPhone()
            );
        }

        $this->projectRepository->addProject($project);

        return $project;
    }

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     */
    public function deleteProject(ProjectId $projectId): void
    {
        $this->projectRepository->removeProject($projectId);
    }

    /**
     * @param RenameProjectRequestDto $renameProjectRequest
     * @throws ValidationException
     * @throws ProjectNotFoundException
     * @return Project
     */
    public function renameProject(RenameProjectRequestDto $renameProjectRequest): Project
    {
        $this->projectValidator->validateRenameProjectRequest($renameProjectRequest);

        $project = $this->projectRepository->getProject($renameProjectRequest->getProjectId());
        $project->rename($renameProjectRequest->getName());

        return $project;
    }
}
