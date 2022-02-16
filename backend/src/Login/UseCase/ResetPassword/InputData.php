<?php

namespace TaskTime\Login\UseCase\ResetPassword;

use Exception;

class InputData
{
	private string $email;

	private function __construct(array $data)
	{
		$this->email = $data["email"];
	}

	public static function create(array $values): InputData
	{
		$data["email"] = $values["email"];
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
