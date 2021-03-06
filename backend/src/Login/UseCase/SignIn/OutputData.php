<?php

namespace TaskTime\Login\UseCase\SignIn;

use Exception;

class OutputData
{
	public string $email;
	public string $token;

	private function __construct(array $data)
	{
		$this->email = $data["email"];
		$this->token = $data["token"];
	}

	public static function create(array $data): OutputData
	{
		return new OutputData($data);
	}

	public function __get(string $name)
	{
		if (!property_exists($this, $name)) {
			throw new Exception(sprintf("Invalid SignIn Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}
}
