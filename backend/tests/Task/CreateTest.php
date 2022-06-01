<?php

namespace Tests\Task;

require_once __DIR__ . "../../../vendor/autoload.php";

use Exception;
use PHPUnit\Framework\TestCase;
use TaskTime\Login\Adapter\JWTAdapter;
use TaskTime\Project\Entity\Project;
use TaskTime\Project\Entity\Projects;
// use TaskTime\Task\Adapter\JWTAdapter;
use TaskTime\Task\Adapter\TaskRepository;
use TaskTime\Task\Controller\CreateController;
// use TaskTime\Task\Controller\SignUpController;
// use TaskTime\Task\Entity\Exceptions\InvalidEmailValue;
// use TaskTime\Task\Entity\Task;
// use TaskTime\Task\Entity\ValueObject\Email;
// use TaskTime\Task\UseCase\SignIn\InputData;
// use TaskTime\Task\UseCase\SignIn\SignIn;
// use TaskTime\Task\UseCase\SignIn\TokenModel;
use TaskTime\User\Adapter\UserRepository;
use TaskTime\User\Entity\User;
use TaskTime\User\UseCase\Authenticated\Authenticated;
use Tests\RequestTest as Request;
use Tests\ResponseTest as Response;


class CreateTest extends TestCase
{
	/*
	 * Para testar essa classe de teste:
	 * composer run test tests/Task/CreateTest.php
	 * OU
	 * php ./vendor/phpunit/phpunit/phpunit tests/Task/CreateTest.php --filter expectTokenIfTaskValid
	 */

	protected static $inicio = false;
	protected static Request $request;
	protected static Response $response;
	protected static $controller;
	protected static $TaskRepository;
	protected static $userRepository;
	// protected static Login $login;
    protected static Project $project;
	protected static User $user;

	protected function setUp(): void
	{

		if (!self::$inicio) {
            $user = new User('', "Nome teste");
            $user->setId(1);
            $user->setUuid("u-123-se");

            $projects = new Projects();
  
            $project = new Project();
            $project->setId(1);
            $project->setUuid("p-123-to");
            $project->setTitle("Projeto de teste");
            $project->setOwner($user);

            $projects->add($project);

            $user->setProjects($projects);

            self::$user = $user;
            self::$project = $project;

			self::$request = new Request([
				"title" => "Titulo task",
                "description" => "Descrição teste",
                "project_uuid" => "",
                "estimated_time" => "",
                "assigners_uuid" => "",
                "credencials" => [
                    "uuid_login" => "user aqui",
                    "uuid_user" => $user->getUuid(),
                    "perfil" => "não importa aqui",
                    "active" => true,
                ],
			]);
			self::$response = new Response();


            
			
			self::$inicio = true;
		}
	}

    /**
     * Deveria cadastrar uma tarefa
     * @test
     */
    public function expectedCreateTask()
    {
        $repositorioTask = new TaskRepository();
        $repositorioUser = new UserRepository();

        $auth = new Authenticated($repositorioUser);

        $controller = new CreateController($repositorioTask, $auth);

        $controller->handler(self::$request, self::$response);

        print_r(self::$response->getReturn());

    }

}
