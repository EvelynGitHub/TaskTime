<?php

namespace Tests\Login;

require_once __DIR__ . "../../../vendor/autoload.php";

use Exception;
use PHPUnit\Framework\TestCase;
use TaskTime\Login\Adapter\JWTAdapter;
use TaskTime\Login\Adapter\LoginRepository;
use TaskTime\Login\Controller\SignUpController;
use TaskTime\Login\Entity\Exceptions\InvalidEmailValue;
use TaskTime\Login\Entity\Login;
use TaskTime\Login\Entity\ValueObject\Email;
use TaskTime\Login\UseCase\SignIn\InputData;
use TaskTime\Login\UseCase\SignIn\SignIn;
use TaskTime\Login\UseCase\SignIn\TokenModel;
use TaskTime\User\Adapter\UserRepository;
use TaskTime\User\Entity\User;
use Tests\RequestTest as Request;
use Tests\ResponseTest as Response;


class SignUpTest extends TestCase
{
	/*
	 * Para testar essa classe de teste:
	 * composer run test tests/Login/SignUpTest.php
	 * OU
	 * php ./vendor/phpunit/phpunit/phpunit tests/Login/SignUpTest.php --filter expectTokenIfLoginValid
	 */

	protected static $inicio = false;
	protected static Request $request;
	protected static Response $response;
	protected static $controller;
	protected static $loginRepository;
	protected static $userRepository;
	protected static Login $login;
	protected static User $user;

	protected function setUp(): void
	{

		if (!self::$inicio) {
			self::$request = new Request([
				"nome" => "Teste",
				"sobrenome" => "Fulano",
				"email" => "admin@gmail.com",
				"pass" => "123",
				"confirm_pass" => "123",
			]);
			self::$response = new Response();
			self::$login = new Login('', new Email("admin@gmail.com"),'', '', '', '');
			self::$user = new User('', '', '', self::$login);

			$adapter = new JWTAdapter();
			$token = new TokenModel($adapter);			

			self::$loginRepository = $this->createMock(LoginRepository::class);
			self::$userRepository = $this->createMock(UserRepository::class);

			self::$controller = new SignUpController(self::$loginRepository, self::$userRepository, $token);
			
			self::$inicio = true;
		}
	}

	/**
	 * Deveria retornar erro caso o email já exitista no banco
	 * @test
	 */
	public function expectExceptionIfEmailDuplicate()
	{
		// ======== Arrumar ========		
		self::$loginRepository->method('getByEmail')->willReturn(self::$login);

		// ======== Afirmar ========
		$this->expectException(Exception::class);
		$this->expectExceptionMessage("O email informado já está em uso!");

		// ======== Agir ========
		self::$controller->handler(self::$request, self::$response);
	}

	/**
	 * Deveria retornar erro se email não for informado
	 * @test
	 */
	public function expectExceptionIfEmailNotFound()
	{
		// ======== Arrumar ========		
		self::$request->setNewValue("email", null);

		// ======== Afirmar ========
		$this->expectException(InvalidEmailValue::class);
		$this->expectExceptionMessage("Obrigatório informar o email!");

		// ======== Agir ========
		self::$controller->handler(self::$request, self::$response);
	}

	/**
	 * Deveria retornar erro se email não for válido
	 * @test
	 */
	public function expectExceptionIfEmailInvalid()
	{
		// ======== Arrumar ========		
		self::$request->setNewValue("email", "test123");

		// ======== Afirmar ========
		$this->expectException(InvalidEmailValue::class);
		$this->expectExceptionMessage("Email Inválido");

		// ======== Agir ========
		self::$controller->handler(self::$request, self::$response);
	}

	/**
	 * Deveria retornar erro se não informar a senha
	 * @test
	 */
	public function expectExceptionIfPasswordNotFound()
	{
		// ======== Arrumar ========		
		self::$request->setNewValue("email", "teste@test.com");
		self::$request->setNewValue("pass", null);

		// ======== Afirmar ========
		$this->expectException(Exception::class);
		$this->expectExceptionMessage("Obrigatório informar a senha!");

		// ======== Agir ========
		self::$controller->handler(self::$request, self::$response);
	}

	/**
	 * Deveria retornar erro se senhas não forem iguais (confimação de senhas)
	 * @test
	 */
	public function expectExceptionIfPasswordsInvalid()
	{
		// ======== Arrumar ========
		$email = new Email("email_teste@gmail.com");

		self::$request->setNewValue("email", $email);
		self::$request->setNewValue("pass", '12');
		self::$request->setNewValue("confirm_pass", '123');

		// ======== Afirmar ========
		$this->expectException(Exception::class);
		$this->expectExceptionMessage("As senhas informadas são diferentes.");

		// ======== Agir ========
		self::$controller->handler(self::$request, self::$response);
	}

	/**
	 * Deveria retornar Token se User cadastrado com sucesso
	 * @test
	 */
	public function expectTokenIfCreateUserSuccess()
	{
		// ======== Arrumar ========
		$email = new Email("email_teste@gmail.com");

		// self::$login->setEmail($email);
		// self::$login->setPassword("abc123");

		self::$request->setNewValue("email", $email);
		self::$request->setNewValue("pass", "abc123");
		self::$request->setNewValue("confirm_pass", "abc123");

		self::$loginRepository->method('getByEmail')->willReturn(null);
		self::$loginRepository->method('register')->willReturn(1);
		self::$userRepository->method('register')->willReturn(1);
		// ======== Agir ========
		self::$controller->handler(self::$request, self::$response);

		// ======== Afirmar ========
		$this->assertNotEmpty(self::$response->getReturn());
	}
}
