<?php

namespace TaskTime\Login\UseCase\ResetPassword;

use Exception;
use TaskTime\Login\Repository\RepositoryInterface;

class ResetPassword
{
    public RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(InputData $input)
    {
        $login = $this->repository->getByEmail($input->email);

        if (!$login) {
            throw new Exception("Usuário não encontrado!");
        }

        $text = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVYXWZ0123456789!@#$%¨&*()_+=";
        $password = substr(str_shuffle($text), 0, 5);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $reset = $this->repository->resetPassword($login->getUuid(), $hash);
        
        if (!$reset) {
            throw new Exception("Não foi possível redefinir a senha!");
        }

        // Falta enviar o email com a $password

        return OutputData::create([
            "message" => "Uma nova senha foi enviada para seu email." 
        ]);
    }
}
