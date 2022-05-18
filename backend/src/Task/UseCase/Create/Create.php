<?php

declare(strict_types=1);

namespace TaskTime\Task\UseCase\Create;

use Exception;
use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\Task\Entity\Task;
use TaskTime\Task\Repository\RepositoryInterface;
use TaskTime\User\Entity\User;
use TaskTime\User\UseCase\Authenticated\Authenticated;

class Create
{
    public RepositoryInterface $repository;
    public Authenticated $authUser;
    public TokenModel $token;

    public function __construct(RepositoryInterface $repository, Authenticated $authUser)
    {
        $this->repository = $repository;
        // $this->token = $token;
        $this->authUser = $authUser;
    }

    public function execute(InputData $input)
    {
        // Deve criar uma nova Task
        // Devo descobri qual é o usuario que está criando a atividade através do token
        // $user = $this->token->getPayloadToken($this->token);

        $userAssigner = $this->authUser->execute($input->credencials);

        $uuid = "";
        $task = new Task($uuid, $input->title, $input->description);
        $task->setProject($input->project);
        $task->setAssigners($userAssigner);

        $this->repository->create($task);

        return [
            "ok"
        ];
    }
}
