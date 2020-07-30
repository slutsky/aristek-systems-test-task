<?php

namespace AristekSystems\TestTask\Exception;

use Exception;

class ProjectNotFoundException extends Exception
{
    public const MESSAGE = 'Project not found';
    public const CODE = 404;

    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE, null);
    }
}