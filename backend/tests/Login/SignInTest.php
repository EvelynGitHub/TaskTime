<?php

namespace Tests\Login;

require_once __DIR__ . "../../../vendor/autoload.php";

use Exception;
use PHPUnit\Framework\TestCase;
use TaskTime\Login\Adapter\JWTAdapter;
use TaskTime\Login\Adapter\LoginRepository;
use TaskTime\Login\Controller\SignInController;
use TaskTime\Login\Entity\Exceptions\InvalidEmailValue;
use TaskTime\Login\Entity\Login;
use TaskTime\Login\Entity\ValueObject\Email;
use TaskTime\Login\UseCase\SignIn\TokenModel;

use Tests\RequestTest as Request;
use Tests\ResponseTest as Response;

// require_once __DIR__ ."/../../src/Login/Adapter/LoginRepository.php";


class SignInTest extends TestCase
{
    /*
	 * Para testar essa classe de teste:
	 * composer run test tests/Login/SignInTest.php
	 * OU
	 * php ./vendor/phpunit/phpunit/phpunit tests/Login/SignInTest.php --filter expectTokenIfLoginValid
	 */

    protected static $inicio = false;
    protected static Request $request;
    protected static Response $response;
    protected static $controller;
    protected static $loginRepository;
    protected static Login $login;

    protected function setUp(): void
    {

        if (!self::$inicio) {
            self::$request = new Request([
                "email" => "admin@gmail.com",
                "pass" => "123"
            ]);
            self::$response = new Response();
            self::$login = new Login('', new Email("admin@gmail.com"), '', '', '', '');

            $adapter = new JWTAdapter();
            $token = new TokenModel($adapter);

            self::$loginRepository = $this->createMock(LoginRepository::class);
            self::$controller = new SignInController(self::$loginRepository, $token);

            self::$inicio = true;
        }
    }

    /**
     * Deveria retornar erro caso o email não seja encontrado
     * @test
     */
    public function expectExceptionUserNotFound()
    {
        // ======== Arrumar ========		
        self::$loginRepository->method('getByEmail')->willReturn(null);

        // ======== Afirmar ========
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Usuário não encontrado!");

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
     * Deveria retornar erro se email não for informado
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
     * Deveria retornar erro se não informar a senha correta
     * @test
     */
    public function expectExceptionIfPasswordInvalid()
    {
        // ======== Arrumar ========
        $email = new Email("email_teste@gmail.com");

        self::$login->setEmail($email);
        self::$login->setPassword("123");

        self::$request->setNewValue("email", $email);
        self::$request->setNewValue("pass", '12');

        self::$loginRepository->method('getByEmail')->willReturn(self::$login);

        // ======== Afirmar ========
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Email ou senha incorreto!");

        // ======== Agir ========
        self::$controller->handler(self::$request, self::$response);
    }

    /**
     * Deveria retornar Token se email e senha forem corretos
     * @test
     */
    public function expectTokenIfLoginValid()
    {
        // ======== Arrumar ========
        $email = new Email("email_teste@gmail.com");
        $pass = password_hash("abc123", PASSWORD_DEFAULT);

        self::$login->setEmail($email);
        self::$login->setPassword($pass);

        self::$request->setNewValue("email", $email);
        self::$request->setNewValue("pass", "abc123");

        self::$loginRepository->method('getByEmail')->willReturn(self::$login);

        // ======== Agir ========
        self::$controller->handler(self::$request, self::$response);

        // ======== Afirmar ========
        $this->assertNotEmpty(self::$response->getReturn());
    }
}
