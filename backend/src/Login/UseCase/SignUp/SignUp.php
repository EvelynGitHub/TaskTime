<?php

namespace TaskTime\Login\UseCase\SignUp;

use Exception;
use TaskTime\Login\Entity\Login;
use TaskTime\Login\Repository\RepositoryInterface as RespositoryLogin;
use TaskTime\User\Repository\RepositoryInterface as RespositoryUser;
use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\Login\UseCase\SignIn\OutputData;
use TaskTime\User\Entity\User;

class SignUp
{
	public RespositoryLogin $repositoryLogin;
	public RespositoryUser $repositoryUser;
	public TokenModel $token;

	public function __construct(RespositoryLogin $repositoryLogin, RespositoryUser $repositoryUser, TokenModel $token)
	{
		$this->repositoryLogin = $repositoryLogin;
		$this->repositoryUser = $repositoryUser;
		$this->token = $token;
	}

	public function execute(InputData $input)
	{
		$uuidLogin = 'login-123-teste-1';
		$login = new Login($uuidLogin, $input->email, $input->password, 'C', 'sdaasd', '');

		$uuidUser = 'user-123-teste-1';
		$user = new User($uuidUser, $input->firstName, $input->lastName, $login);

		$loginId = $this->repositoryLogin->register($login);

		if (!$loginId) {
			throw new Exception("Não foi possível efetuar o cadastro de login.");
		}

		$userId = $this->repositoryUser->register($loginId, $user);

		if (!$userId) {
			throw new Exception("Não foi possível efetuar o cadastro, tente mais tarde.");
		}

		return OutputData::create([
			"email" => $input->email,
			"token" => $this->token->create([
				"expiration_at" => "2h",
				"email" => $input->email,
				"uuid" => $uuidLogin
			])
		]);
	}
}
