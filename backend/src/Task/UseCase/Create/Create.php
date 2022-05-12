<?php

declare(strict_types=1);

namespace TaskTime\Task\UseCase\Create;

use Exception;
use TaskTime\Task\Repository\RepositoryInterface;

class Create
{
    public RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        // Deve criar uma nova Task
    }
}
