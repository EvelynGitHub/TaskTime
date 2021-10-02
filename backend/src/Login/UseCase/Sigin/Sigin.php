<?php

namespace TaskTime\Login\UseCase\Sigin;

use Exception;
use TaskTime\Login\Repository\RepositoryInterface;

class Sigin
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
		if(!password_verify($input->password, $loginExist->password)){
			throw new Exception("Email ou senha inválidos!");
		}

		return OutputData::create([
			"email" => $input->email,
			"token" => $this->token->create([
				"expiration_at" => "2h",
			])
		]);

	}
}
