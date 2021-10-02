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
		$type = "C"; //Comum

		if($email == "admin@gmail.com"){
			$type = "A"; // Administrador
		}
		if($email == "cliente@gmail.com"){
			$type = "B"; // Cliente
		}

		$email = new Email($email);
		return new Login($uuid, $email, "123", $type, "", "Ativo");
	}
}
