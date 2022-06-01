<?php

declare(strict_types=1);

namespace TaskTime\Repository\Repository;

use TaskTime\Project\Entity\Project;

interface ProjectRepositoryInterface
{
	public function create(Project $Repository): ?Project;
	public function getByUuid(string $uuidProject): ?Project;
}
