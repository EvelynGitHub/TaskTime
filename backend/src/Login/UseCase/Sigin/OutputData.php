<?php

namespace TaskTime\Login\UseCase\Sigin;

use Exception;

class OutputData
{
	private string $email;
	private TokenModel $token;

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
			throw new Exception(sprintf("Invalid Sigin Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}
}
