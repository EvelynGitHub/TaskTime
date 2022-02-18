<?php

namespace TaskTime\Login\UseCase\SignIn;

use Exception;
use TaskTime\Login\Entity\Exceptions\InvalidEmailValue;
use TaskTime\Login\Entity\ValueObject\Email;

class InputData
{
	public Email $email;
	public string $password;

	private function __construct(array $data)
	{
		try {
			$this->email = new Email($data["email"]);
			$this->password = $data['password'];
		} catch (InvalidEmailValue $iev) {
			throw new InvalidEmailValue($iev->getMessage());
		} catch (\TypeError $te) {
			throw new Exception("Obrigatório informar a senha!");
		}
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
