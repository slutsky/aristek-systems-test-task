<?php

namespace AristekSystems\TestTask\Tests\Entity;

use AristekSystems\TestTask\Entity\ProjectId;
use PHPUnit\Framework\TestCase;

class ProjectIdTest extends TestCase
{
    public function testCreation(): void
    {
        $projectId = new ProjectId(1);

        $this->assertEquals($projectId->toValue(), 1);
    }
}