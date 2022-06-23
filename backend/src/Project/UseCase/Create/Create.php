<?php

declare(strict_types=1);

namespace TaskTime\Project\UseCase\Create;

use TaskTime\Project\Entity\Project;
use TaskTime\Repository\Repository\ProjectRepositoryInterface;
use TaskTime\User\Repository\RepositoryInterface;

class Create
{
    public RepositoryInterface $userRepository;
    public ProjectRepositoryInterface $projectRepository;

    public function __construct(RepositoryInterface $userRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    public function execute(InputData $input): Project
    {
        // Seria possível que não encontrasse o usuário porque houve manipulação do token para ataques?
        $authUser = $this->userRepository->getUserByUuidLogin($input->credentials->uuidLogin);

        $project = new Project;

        $project->setTitle($input->title);
        $project->setDescription($input->description);
        $project->setOwner($authUser);

        $projectSave = $this->projectRepository->create($project);

        return $projectSave;
    }
}
