<?php

namespace TaskTime\Login\UseCase\SignIn;

use Exception;
use TaskTime\Login\Repository\RepositoryInterface;

class SignIn
{
	public RepositoryInterface $repository;
	public TokenModel $token;

	public function __construct(RepositoryInterface $repository, TokenModel $token)
	{
		$this->repository = $repository;
		$this->token = $token;
	}

	public function execute(InputData $input)
	{
		$loginExist = $this->repository->getByEmail($input->email);

		if(!$loginExist){
			throw new Exception("Usuário não encontrado!");
		}

		// Verifica senhas
		if(!password_verify($input->password, $loginExist->getPassword())){
			throw new Exception("Email ou senha incorreto!");
		}

		// Dar um jeito de conseguir o perfil do usuário que logou no sistema
		// $user = $this->repository->getUserByLogin();

		return OutputData::create([
			"email" => $input->email,
			"token" => $this->token->create([
				"expiration_at" => "2h",
				"uuid_login" => $loginExist->getUuid()
			])
		]);

	}
}
