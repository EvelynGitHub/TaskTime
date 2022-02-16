<?php

namespace TaskTime\Login\UseCase\ResetPassword;

use Exception;

class OutputData
{
	private string $message;

	private function __construct(array $data)
	{
		$this->message = $data["message"];
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
