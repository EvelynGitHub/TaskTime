<?php

namespace TaskTime\Login\Controller;

use TaskTime\Login\Repository\RepositoryInterface;
use TaskTime\Login\UseCase\SignIn\InputData;
use TaskTime\Login\UseCase\SignIn\SignIn;
use TaskTime\Login\UseCase\SignIn\TokenModel;
// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class SignInController
{
	private RepositoryInterface $repository;
	private TokenModel $token;

	public function __construct(RepositoryInterface $repository, TokenModel $token)
	{
		$this->repository = $repository;
		$this->token = $token;
	}

	// public function handle(Request $request, Response $response, array $args = []): Response
	public function handler($request, $response)
	{
		$signIn = new SignIn($this->repository, $this->token);

		// $bodyArray = json_decode($request->getBody()->getContents(), true);

		$input = InputData::create([
			'email' => $request->query("email"),
            'pass' => $request->query("pass"),
		]);

		$output = $signIn->execute($input);

		$response->getBody()->write($output->token);
	}

}
