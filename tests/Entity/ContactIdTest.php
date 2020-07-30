<?php

namespace AristekSystems\TestTask\Tests\Entity;

use AristekSystems\TestTask\Entity\ContactId;
use PHPUnit\Framework\TestCase;

class ContactIdTest extends TestCase
{
    public function testCreation(): void
    {
        $contactId = new ContactId(1);

        $this->assertEquals($contactId->toValue(), 1);
    }
}