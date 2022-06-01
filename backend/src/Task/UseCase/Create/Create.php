<?php

declare(strict_types=1);

namespace TaskTime\Task\UseCase\Create;

use Exception;
use TaskTime\Repository\Repository\ProjectRepositoryInterface;
use TaskTime\Task\Entity\Task;
use TaskTime\Task\Repository\RepositoryInterface;
use TaskTime\User\Repository\RepositoryInterface as UserRepositoryInterface;

class Create
{
    public RepositoryInterface $repository;
    public UserRepositoryInterface $userRepository;
    public ProjectRepositoryInterface $projectRepository;

    public function __construct(RepositoryInterface $repository, UserRepositoryInterface $userRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    public function execute(InputData $input): Task
    {
        // Seria possível que não encontrasse o usuário porque houve manipulação do token para ataques?
        $authUser = $this->userRepository->getUserByUuidLogin($input->credentials->uuidLogin);

        // Busco projeto
        $project = $this->projectRepository->getByUuid($input->project);

        // Deve criar uma nova Task
        $uuid = (string) rand(0, 99999);
        $task = new Task($uuid, $input->title, $input->description);
        $task->setProject($project);
        $task->setOwner($authUser);
        $task->setEstimatedTime($input->estimatedTime);

        // Futuramente, deve-se verificar se esse pessoa pode criar uma tarefa para o projeto?
        if ($input->assignersUuid) {
            $task->setAssigners($authUser);
        } else {
            // Senão existir esse cara ?
            $userAssigner = $this->userRepository->getUserByUuid($input->assignersUuid);
            $task->setAssigners($userAssigner);
        }

        $taskSave = $this->repository->create($task);

        return $taskSave;
    }
}
