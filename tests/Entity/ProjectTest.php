<?php

namespace AristekSystems\TestTask\Tests\Entity;

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

        $project = new Project(
            $expectedName,
            $expectedCode,
            $expectedUrl,
            $expectedBudget
        );

        $this->assertEquals($expectedName, $project->getName());
        $this->assertEquals($expectedCode, $project->getCode());
        $this->assertEquals($expectedUrl, $project->getUrl());
        $this->assertEquals($expectedBudget, $project->getBudget());

        return $project;
    }

    /**
     * @depends testCreation
     * @param Project $project
     */
    public function testCreateContact(Project $project): void
    {
        $expectedFirstName = 'Jon';
        $expectedLastName = 'Doe';
        $expectedPhone = '+012 (34) 567-89-10';

        $contact = $project->createContact(
            $expectedFirstName,
            $expectedLastName,
            $expectedPhone
        );

        $this->assertEquals($expectedFirstName, $contact->getFirstName());
        $this->assertEquals($expectedLastName, $contact->getLastName());
        $this->assertEquals($expectedPhone, $contact->getPhone());

        $contacts = $project->getContacts();
        $this->assertCount(1, $contacts);
        $this->assertEquals($contact, $contacts[0]);
        $this->assertEquals($expectedFirstName, $contacts[0]->getFirstName());
        $this->assertEquals($expectedLastName, $contacts[0]->getLastName());
        $this->assertEquals($expectedPhone, $contacts[0]->getPhone());
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