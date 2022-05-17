<?php

declare(strict_types=1);

namespace TaskTime\Task\UseCase\Create;

use Exception;
use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\Task\Entity\Task;
use TaskTime\Task\Repository\RepositoryInterface;
use TaskTime\User\Entity\User;
use TaskTime\User\UseCase\FindByUuid\FindByUuid;

class Create
{
    public RepositoryInterface $repository;
    public FindByUuid $findUser;
    public TokenModel $token;

    public function __construct(RepositoryInterface $repository, FindByUuid $findByUuid)
    {
        $this->repository = $repository;
        // $this->token = $token;
        $this->findUser = $findByUuid;
    }

    public function execute(InputData $input)
    {
        // Deve criar uma nova Task
        // Devo descobri qual é o usuario que está criando a atividade através do token
        // $user = $this->token->getPayloadToken($this->token);

        $userAssigner = new User();

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
