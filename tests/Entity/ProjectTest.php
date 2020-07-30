<?php

namespace AristekSystems\TestTask\Tests\Entity;

use AristekSystems\TestTask\Entity\Contact;
use AristekSystems\TestTask\Entity\Project;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /**
     * @return Project
     */
    public function testCreation(): Project
    {
        $expectedName = 'Project';
        $expectedCode = 'project';
        $expectedUrl = 'http://example.com/my-page';
        $expectedBudget = 100;
        $expectedContactFirstName = 'Jon';
        $expectedContactLastName = 'Doe';
        $expectedContactPhone = '+012 (34) 567-89-10';

        $project = new Project(
            $expectedName,
            $expectedCode,
            $expectedUrl,
            $expectedBudget,
            [
                new Contact(
                    $expectedContactFirstName,
                    $expectedContactLastName,
                    $expectedContactPhone
                )
            ]
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

        return $project;
    }

    /**
     * @depends testCreation
     * @param Project $project
     */
    public function testUpdate(Project $project): void
    {
        $expectedName = 'new Project';

        $project->rename($expectedName);

        $this->assertEquals($expectedName, $project->getName());
    }
}