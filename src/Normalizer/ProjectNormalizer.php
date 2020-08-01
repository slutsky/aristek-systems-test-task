<?php

namespace AristekSystems\TestTask\Normalizer;

use AristekSystems\TestTask\Entity\Contact;
use AristekSystems\TestTask\Entity\Project;

class ProjectNormalizer
{
    public function normalize(Project $project): array
    {
        return [
            'id' => $project->getId()->toValue(),
            'name' => $project->getName(),
            'code' => $project->getCode(),
            'url' => $project->getUrl(),
            'budget' => $project->getBudget(),
            'contacts' => array_map(fn (Contact $contact) => [
                'id' => $contact->getId()->toValue(),
                'girstName' => $contact->getFirstName(),
                'firstName' => $contact->getFirstName(),
                'phone' => $contact->getPhone()
            ], $project->getContacts())
        ];
    }
}
