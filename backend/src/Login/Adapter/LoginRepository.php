<?php

namespace TaskTime\Login\Adapter;

use TaskTime\Login\Entity\Login;
use TaskTime\Login\Entity\ValueObject\Email;
use TaskTime\Login\Repository\RepositoryInterface;

require_once __DIR__ . "../../Repository/RepositoryInterface.php";

class LoginRepository implements RepositoryInterface
{

	public function getByEmail(string $email = null): ?Login
	{

		$uuid = "123123-3123sfds-41234234-45465sdf";
		$type = "";

		if ($email == "admin@gmail.com") {
			$type = "A"; // Administrador
		} else if ($email == "cliente@gmail.com") {
			$type = "B"; // Cliente
		} else if ($email == "dev@gmail.com") {
			$type = "C"; // Dev
		} else {
			return null;
		}

		$pass = password_hash("123", PASSWORD_DEFAULT);

		$email = new Email($email);
		return new Login($uuid, $email, $pass, $type, "", "Ativo");
	}


	public function register(Login $login): ?int
	{
		return null;
	}
}
