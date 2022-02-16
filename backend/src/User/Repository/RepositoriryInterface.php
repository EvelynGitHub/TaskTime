<?php

declare(strict_types=1);

namespace TaskTime\User\Repository;

use TaskTime\User\Entity\User;

interface RepositoryInterface
{
	public function register(int $idLogin, User $user): ?User;
}
