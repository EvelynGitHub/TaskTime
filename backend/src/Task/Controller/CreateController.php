<?php

namespace TaskTime\Task\Controller;

use TaskTime\Repository\Repository\ProjectRepositoryInterface;
use TaskTime\Task\Repository\RepositoryInterface as TaskRepositoryInterface;
use TaskTime\Task\UseCase\Create\Create;
use TaskTime\Task\UseCase\Create\InputData;
use TaskTime\User\Repository\RepositoryInterface as UserRepositoryInterface;

// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class CreateController
{
	private TaskRepositoryInterface $taskRepository;
	private UserRepositoryInterface $userRepository;
	private ProjectRepositoryInterface $projectRepository;
	// private TokenModel $token;

	public function __construct(TaskRepositoryInterface $taskRepository, UserRepositoryInterface $userRepository, ProjectRepositoryInterface $projectRepository)
	{
		$this->taskRepository = $taskRepository;
		$this->userRepository = $userRepository;
		$this->projectRepository = $projectRepository;;
	}

	// public function handle(Request $request, Response $response, array $args = []): Response
	public function handler($request, $response)
	{
		$create = new Create($this->taskRepository, $this->userRepository, $this->projectRepository);

		// $bodyArray = json_decode($request->getBody()->getContents(), true);

		$input = InputData::create([
			"title" => $request->query("title"),
			"description" => $request->query("description"),
			"estimated_time" => $request->query("estimated_time"),
			"assigners_uuid" => $request->query("assigners_uuid"),
			"credentials" => $request->query("credentials")
		]);

		$output = $create->execute($input);

		$response->getBody()->write($output);
	}
}
