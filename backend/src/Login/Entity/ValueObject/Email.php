<?php

namespace TaskTime\Login\Entity\ValueObject;

use TaskTime\Login\Entity\Exceptions\InvalidEmailValue;

class Email
{
	private string $email;

	public function __construct(string $email)
	{
		if (!$this->validate($email)) {
			throw new InvalidEmailValue("Email Invalido");
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
