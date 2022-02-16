<?php

namespace TaskTime\Login\UseCase\SignIn;

class TokenModel
{
	private TokenInterface $interface;

	public function __construct(TokenInterface $interface)
	{
		$this->interface = $interface;
	}

	public function create(array $data): string
	{
		return $this->interface->generateToken($data);
	}

	public function getPayloadToken(string $token): ?array
	{
		return $this->interface->validadeToken($token);
	}
}
