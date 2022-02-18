<?php

namespace TaskTime\Login\Entity\ValueObject;

use TaskTime\Login\Entity\Exceptions\InvalidEmailValue;

class Email
{
	private string $email;

	public function __construct(?string $email)
	{
		if (is_null($email)) {
			throw new InvalidEmailValue("Obrigatório informar o email!");
		}
		if (!$this->validate($email)) {
			throw new InvalidEmailValue("Email Inválido");
		}

		$this->email = $email;
	}

	public function __toString()
	{
		return $this->email;
	}

	private function validate(string $email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}
