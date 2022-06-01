<?php

declare(strict_types=1);

namespace TaskTime\User\UseCase\Authenticated;

use Exception;
use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\Task\Entity\Task;
use TaskTime\User\Repository\RepositoryInterface;
use TaskTime\User\UseCase\Authenticated\InputDataAuth;

class Authenticated
{
    public RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(InputDataAuth $input)
    {
        $user = $this->repository->getUserByUuidLogin($input->uuidLogin);

        return $user;
    }
}
