<?php

namespace TaskTime\Task\Controller;

use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\Task\Repository\RepositoryInterface;
use TaskTime\Task\UseCase\Create\Create;
use TaskTime\Task\UseCase\Create\InputData;
use TaskTime\User\UseCase\FindByUuid\FindByUuid;

// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class CreateController
{
	private RepositoryInterface $repository;
	private FindByUuid $findByUuid;
	// private TokenModel $token;

	public function __construct(RepositoryInterface $repository, FindByUuid $findByUuid)
	{
		$this->repository = $repository;
		// $this->token = $token;
		$this->findByUuid = $findByUuid;
	}

	// public function handle(Request $request, Response $response, array $args = []): Response
	public function handler($request, $response)
	{
		$create = new Create($this->repository, $this->findByUuid);

		// $bodyArray = json_decode($request->getBody()->getContents(), true);

		$input = InputData::create([
			"title" => $request->query("title"),
			"description" => $request->query("description"),
			"estimated_time" => $request->query("estimated_time"),
			"assigners_uuid" => $request->query("assigners_uuid")
		]);

		$output = $create->execute($input);

		$response->getBody()->write($output);
	}
}
