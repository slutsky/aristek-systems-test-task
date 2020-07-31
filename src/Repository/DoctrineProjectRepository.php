<?php

namespace AristekSystems\TestTask\Repository;

use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use AristekSystems\TestTask\Exception\ProjectNotFoundException;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProjectRepository implements ProjectRepositoryInterface
{
    /** @var EntityManagerInterface */ 
    private $entityManager;

    /** @var ObjectRepository */
    private $projectRepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->projectRepository = $entityManager->getRepository(Project::class);
    }

    /**
     * @return Project[]
     */
    public function getProjects(): array
    {
        return $this->projectRepository->findAll(); 
    }

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     * @return Project
     */
    public function getProject(ProjectId $projectId): Project
    {
        $project = $this->projectRepository->find($projectId);

        if (null === $project) {
            throw new ProjectNotFoundException();
        }

        return $project;
    }

    /**
     * @param Project $project
     */
    public function addProject(Project $project): void
    {
        $this->entityManager->persist($project);
    }

    /**
     * @param ProjectId $projectId
     * @throws ProjectNotFoundException
     */
    public function removeProject(ProjectId $projectId): void
    {
        $project = $this->projectRepository->find($projectId);

        if (null === $project) {
            throw new ProjectNotFoundException();
        }

        $this->entityManager->remove($project);
    }
}
