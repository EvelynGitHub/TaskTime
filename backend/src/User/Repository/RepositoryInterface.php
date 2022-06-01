<?php

declare(strict_types=1);

namespace TaskTime\User\Repository;

use TaskTime\User\Entity\User;

interface RepositoryInterface
{
	public function register(int $idLogin, User $user): ?int;
	public function update(User $user): bool;
	public function delete(string $uuid): bool;
	public function getUserByUuid(string $uuid): User;
	public function getUserByUuidLogin(string $uuidLogin): User;
}
