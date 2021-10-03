<?php

namespace Tests\Login;
require_once __DIR__ . "../../../vendor/autoload.php";
use Exception;
use PHPUnit\Framework\TestCase;
use TaskTime\Login\Adapter\JWTAdapter;
use TaskTime\Login\Adapter\LoginRepository;
use TaskTime\Login\Controller\SiginController;
use TaskTime\Login\UseCase\Sigin\InputData;
use TaskTime\Login\UseCase\Sigin\Sigin;
use TaskTime\Login\UseCase\Sigin\TokenModel;

// require_once __DIR__ ."/../../src/Login/Adapter/LoginRepository.php";


class SiginTest extends TestCase {
	/*
	 * Para testar essa classe de teste:
	 * composer run test tests/Login/SiginTest.php
	 */

	/**
	 * @test
	 */
	public function expectExceptionUserNotFound()
	{
		// ======== Arrumar ========
		//$repository = new LoginRepository();
		$repository = $this->createMock(LoginRepository::class);
		$repository->method('getByEmail')->willReturn(null);

		$adapterJWT = new JWTAdapter();
		$token = new TokenModel($adapterJWT);
		// $controller = new SiginController($repository, $token);
		$sigin = new Sigin($repository, $token);
		$input = InputData::create([
			"email" => "admin@gmail.com",
			"pass" => "123"]);

		// ======== Afirmar ========
		// Nesse caso a afirmação fica em cima porque é uma Exception
		$this->expectException(Exception::class);
		$this->expectExceptionMessage("Usuário não encontrado!");

		// ======== Agir ========
		// $controller->handler();
		$sigin->execute($input);

	}
}
