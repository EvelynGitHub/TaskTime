<?php

namespace TaskTime\User\Controller;

use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\User\Repository\RepositoryInterface;
// use TaskTime\User\UseCase\Create\Create;
// use TaskTime\User\UseCase\Create\InputData;
// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class FindByUuidController
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
		// $create = new Create($this->repository, $this->token);

		// // $bodyArray = json_decode($request->getBody()->getContents(), true);

		// $input = InputData::create([
		// 	"uuid" => $request->query("uuid")
		// ]);

		// $output = $create->execute($input);

		// $response->getBody()->write($output);
	}
}
