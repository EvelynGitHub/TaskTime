<?php

declare(strict_types=1);

namespace TaskTime\Task\Adapter;

use TaskTime\Task\Entity\Task;
use TaskTime\Task\Entity\Tasks;
use TaskTime\Task\Repository\RepositoryInterface;

class TaskRepository implements RepositoryInterface
{
    public function create(Task $task)
    {
    }

    public function update(Task $task): bool
    {
        return false;
    }

    public function delete(string $uuid): bool
    {
        return false;
    }

    public function getTaskByUuid(string $uuid): Task
    {
        return (new Task('', '', ''));
    }

    public function getTasksByUserUuid(string $uuid): Tasks
    {
        return new Tasks();
    }
}
