<?php

declare(strict_types=1);

namespace TaskTime\Task\Repository;

use TaskTime\Task\Entity\Task;
use TaskTime\Task\Entity\Tasks;

interface RepositoryInterface
{
	public function create(Task $task) : Task;
	public function update(Task $task): bool;
	public function delete(string $uuid): bool;
	public function getTaskByUuid(string $uuid): Task;
	public function getTasksByUserUuid(string $uuid): Tasks;
}
