<?php

declare(strict_types=1);

namespace TaskTime\Login\Repository;

use TaskTime\Login\Entity\Login;

interface RepositoryInterface
{
	public function getByEmail(string $email = null): ?Login;
}
