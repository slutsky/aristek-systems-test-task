<?php

namespace AristekSystems\TestTask\Controller;

use AristekSystems\TestTask\Dto\CreateContactRequestDto;
use AristekSystems\TestTask\Dto\CreateProjectRequestDto;
use AristekSystems\TestTask\Dto\RenameProjectRequestDto;
use AristekSystems\TestTask\Entity\Contact;
use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use AristekSystems\TestTask\Service\ProjectService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController
{
    /** @var ProjectService */
    private $projectService;

    /**
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @Route("/projects", methods={"GET"}, name="get_projects")
     * @return JsonResponse
     */
    public function getProjectsAction(): JsonResponse
    {
        $projects = $this->projectService->getProjects();
        
        return new JsonResponse(array_map(fn (Project $project) => [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'code' => $project->getCode(),
            'url' => $project->getUrl(),
            'budget' => $project->getBudget(),
            'contacts' => array_map(fn (Contact $contact) => [
                'girstName' => $contact->getFirstName(),
                'firstName' => $contact->getFirstName(),
                'phone' => $contact->getPhone()
            ], $project->getContacts())
        ], $projects), Response::HTTP_OK);
    }

    /**
     * @Route("/projects/{projectId}", methods={"GET"}, name="get_project")
     * @param int $projectId
     * @return JsonResponse
     */
    public function getProjectAction(int $projectId): JsonResponse
    {
        $project = $this->projectService->getProject(new ProjectId($projectId));

        return new JsonResponse([
            'id' => $project->getId(),
            'name' => $project->getName(),
            'code' => $project->getCode(),
            'url' => $project->getUrl(),
            'budget' => $project->getBudget(),
            'contacts' => array_map(fn (Contact $contact) => [
                'girstName' => $contact->getFirstName(),
                'firstName' => $contact->getFirstName(),
                'phone' => $contact->getPhone()
            ], $project->getContacts())
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/projects", methods={"POST"}, name="create_project")
     * @param Request $request
     * @return JsonResponse
     */
    public function createProjectAction(Request $request): JsonResponse
    {
        $requestContent = json_decode($request->getContent(), true);

        $project = $this->projectService->createProject(new CreateProjectRequestDto(
            $requestContent['name'] ?? null,
            $requestContent['code'] ?? null,
            $requestContent['url'] ?? null,
            $requestContent['budget'] ?? null,
            array_map(fn (array $contactContent) => new CreateContactRequestDto(
                $contactContent['firstName'] ?? null,
                $contactContent['lastName'] ?? null,
                $contactContent['phone'] ?? null
            ), $requestContent['contacts'] ?? [])
        ));

        return new JsonResponse([
            'id' => $project->getId(),
            'name' => $project->getName(),
            'code' => $project->getCode(),
            'url' => $project->getUrl(),
            'budget' => $project->getBudget(),
            'contacts' => array_map(fn (Contact $contact) => [
                'girstName' => $contact->getFirstName(),
                'firstName' => $contact->getFirstName(),
                'phone' => $contact->getPhone()
            ], $project->getContacts())
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/projects/{projectId}", methods={"PATCH"}, name="rename_project")
     * @param Request $request
     * @param integer $projectId
     * @return JsonResponse
     */
    public function renameProjectAction(Request $request, int $projectId): JsonResponse
    {
        $requestContent = json_decode($request->getContent(), true);

        $project = $this->projectService->renameProject(new RenameProjectRequestDto(
            new ProjectId($projectId),
            $requestContent['name'] ?? null
        ));

        return new JsonResponse([
            'id' => $project->getId(),
            'name' => $project->getName(),
            'code' => $project->getCode(),
            'url' => $project->getUrl(),
            'budget' => $project->getBudget(),
            'contacts' => array_map(fn (Contact $contact) => [
                'girstName' => $contact->getFirstName(),
                'firstName' => $contact->getFirstName(),
                'phone' => $contact->getPhone()
            ], $project->getContacts())
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/projects/{projectId}", methods={"DELETE"}, name="delete_project")
     * @param ProjectId $projectId
     */
    public function deleteProjectAction(int $projectId): JsonResponse
    {
        $this->projectService->deleteProject(new ProjectId($projectId));

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
