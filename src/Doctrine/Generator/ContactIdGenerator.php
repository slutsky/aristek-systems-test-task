<?php

namespace AristekSystems\TestTask\Doctrine\Generator;

use AristekSystems\TestTask\Entity\ContactId;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

class ContactIdGenerator extends AbstractIdGenerator
{
    /**
     * @var string
     */
    private $sequenceName;

    /**
     * @param string|null $sequenceName
     */
    public function __construct($sequenceName = null)
    {
        $this->sequenceName = $sequenceName;
    }

    /**
     * {@inheritDoc}
     */
    public function generate(EntityManager $em, $entity)
    {
        $value = (int) $em->getConnection()->lastInsertId($this->sequenceName);

        return new ContactId($value);
    }

    /**
     * {@inheritdoc}
     */
    public function isPostInsertGenerator()
    {
        return true;
    }
}
