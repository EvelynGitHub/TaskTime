<?php

declare(strict_types=1);

namespace TaskTime\User\UseCase\FindByUuid;

use Exception;
use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\Task\Entity\Task;
use TaskTime\User\Repository\RepositoryInterface;
use TaskTime\User\UseCase\FindByUuid\InputData;

class FindByUuid
{
    public RepositoryInterface $repository;
    public TokenModel $token;

    public function __construct(RepositoryInterface $repository, TokenModel $token)
    {
        $this->repository = $repository;
        $this->token = $token;
    }

    public function execute(InputData $input)
    {
        $user = $this->repository->getUserByUuid($input->uuid);

        return $user;
    }
}
