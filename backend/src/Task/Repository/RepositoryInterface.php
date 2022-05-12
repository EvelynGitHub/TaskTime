<?php

declare(strict_types=1);

namespace TaskTime\Task\Repository;

use TaskTime\Task\Entity\Task;

interface RepositoryInterface
{
	public function create(Task $task);
	public function update(Task $task): bool;
}
