<?php

declare(strict_types=1);

namespace TaskTime\User\Adapter;

use TaskTime\Login\Entity\Login;
use TaskTime\Login\Entity\ValueObject\Email;
use TaskTime\User\Entity\User;
use TaskTime\User\Repository\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    public function register(int $idLogin, User $user): ?int
    {
        // Relacionar o 
        return null;
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(string $uuid): bool
    {
        return false;
    }

    public function getUserByUuid(string $uuid): User
    {
        return new User('', '', '', new Login('', new Email(''), '', '', '', ''));
    }
}
