<?php

namespace AristekSystems\TestTask\Tests\Entity;

use AristekSystems\TestTask\Entity\Project;
use AristekSystems\TestTask\Entity\ProjectId;
use PHPUnit\Framework\TestCase;

class ProjectIdTest extends TestCase
{
    public function testCreation(): void
    {
        $projectId = new ProjectId(1);

        $this->assertEquals($projectId->toValue(), 1);
    }

    public function testEquals(): void
    {
        $projectId = new ProjectId(1);

        $this->assertTrue($projectId->equals(new ProjectId(1)));
        $this->assertFalse($projectId->equals(new ProjectId(2)));
        $this->assertFalse($projectId->equals(new ProjectId()));
    }

    public function testEqualsWithoutValue(): void
    {
        $projectId = new ProjectId();

        $this->assertTrue($projectId->equals($projectId));
        $this->assertFalse($projectId->equals(new ProjectId()));
        $this->assertFalse($projectId->equals(new ProjectId(1)));
    }
}
