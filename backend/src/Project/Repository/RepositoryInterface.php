<?php

declare(strict_types=1);

namespace TaskTime\Repository\Repository;

use TaskTime\Project\Entity\Project;

interface RepositoryInterface
{
	public function create(Project $Repository): ?int;
}
