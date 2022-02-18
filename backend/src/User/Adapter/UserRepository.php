<?php

declare(strict_types=1);

namespace TaskTime\User\Adapter;

use TaskTime\User\Entity\User;
use TaskTime\User\Repository\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    public function register(int $idLogin, User $user): ?int
    {
        // Relacionar o 
        return null;
    }
}
