<?php

namespace TaskTime\User\Controller;

use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\User\Repository\RepositoryInterface;
use TaskTime\User\UseCase\Authenticated\Authenticated;
use TaskTime\User\UseCase\Authenticated\InputDataAuth;

// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class AuthenticatedController
{
	private RepositoryInterface $repository;
	// private TokenModel $token;

	public function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
		// $this->token = $token;
	}

	// Dentro deste $request já deve vir alguns dados do usuario/login que está logado no momento, 
	// os dados seriam colocados na $request por um middleware sob a chave credentials
	public function handler($request, $response)
	{
		$userActive = new Authenticated($this->repository);

		$input = InputDataAuth::create($request->query("credentials"));

		$userLogged = $userActive->execute($input);

		$response->getBody()->write($userLogged);
	}
}
