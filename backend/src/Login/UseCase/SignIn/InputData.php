<?php

namespace TaskTime\Login\UseCase\SignIn;

use Exception;

class InputData
{
	private string $email;
	private string $password;

	private function __construct(array $data)
	{
		$this->email = $data["email"];
		$this->password = $data['password'];
	}

	public static function create(array $values): InputData
	{
		$data["email"] = $values["email"];
		$data["password"] = $values["pass"];
		return new InputData($data);
	}

	public function __get(string $name)
	{
		if (!property_exists($this, $name)) {
			throw new Exception(sprintf("Invalid SignIn Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}
}
