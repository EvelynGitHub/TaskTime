<?php

namespace TaskTime\Login\Controller;

use TaskTime\Login\Repository\RepositoryInterface;
use TaskTime\Login\UseCase\ResetPassword\ResetPassword;
use TaskTime\Login\UseCase\ResetPassword\InputData;
// use Psr\Http\Message\RequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;

class ResetPasswordController
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // public function handle(Request $request, Response $response, array $args = []): Response
    public function handler($request, $response)
    {
        $SignIn = new ResetPassword($this->repository);

        // $bodyArray = json_decode($request->getBody()->getContents(), true);

        $input = InputData::create([
            'email' => $request->query("email")
        ]);

        $output = $SignIn->execute($input);

        $response->getBody()->write($output->message);
    }
}
