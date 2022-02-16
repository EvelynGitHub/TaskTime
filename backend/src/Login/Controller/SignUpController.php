<?php

namespace TaskTime\Login\Controller;

use TaskTime\Login\Repository\RepositoryInterface as RepositoryLogin;
use TaskTime\User\Repository\RepositoryInterface as RepositoryUser;
use TaskTime\Login\UseCase\SignUp\InputData;
use TaskTime\Login\UseCase\SignUp\SignUp;
use TaskTime\Login\UseCase\SignIn\TokenModel;
// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class SignUpController
{
	private RepositoryLogin $repositoryLogin;
	private RepositoryUser $repositoryUser;
	private TokenModel $tokenModel;

	public function __construct(RepositoryLogin $repositoryLogin, RepositoryUser $repositoryUser, TokenModel $tokenModel)
	{
		$this->repositoryLogin = $repositoryLogin;
		$this->repositoryUser = $repositoryUser;
		$this->tokenModel = $tokenModel;
	}

	// public function handle(Request $request, Response $response, array $args = []): Response
	public function handler($request, $response)
	{
		$signUp = new SignUp($this->repositoryLogin, $this->repositoryUser, $this->tokenModel);

		// $bodyArray = json_decode($request->getBody()->getContents(), true);

		$input = InputData::create([
			'firstName' => $request->query("nome"),
			'lastName' => $request->query("sobrenome"),
			'email' => $request->query("email"),
            'pass' => $request->query("pass"),
            'confirm_pass' => $request->query("confirm_pass"),
		]);

		$output = $signUp->execute($input);

		$response->getBody()->write($output->token);
	}

}
