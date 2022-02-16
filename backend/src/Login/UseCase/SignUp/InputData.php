<?php

namespace TaskTime\Login\UseCase\SignUp;

use Exception;
use TaskTime\Login\Entity\ValueObject\Email;

class InputData
{
	private string $firstName;
	private string $lastName;
	private Email $email;
	private string $password;

	private function __construct(array $data)
	{
		$this->firstName = $data["email"];
		$this->lastName = $data["lastName"];
		$this->email = $data["email"];
		$this->setPass($data['pass'], $data["confirm_pass"]);
	}

	public static function create(array $values): InputData
	{
	// 	$data["email"] = $values["email"];
	// 	$data["password"] = $values["pass"];
		return new InputData($values);
	}

	public function __get(string $name)
	{
		if (!property_exists($this, $name)) {
			throw new Exception(sprintf("Invalid SignUp Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}

	private function setPass(string $pass, string $confirmPass)
	{
		if ($pass !== $confirmPass) {
			throw new Exception("As senhas informadas são diferentes.");
		}

		return $this->password;
	}
}
