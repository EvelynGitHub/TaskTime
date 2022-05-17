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

	public function getPayloadToken(string $token = null): ?array
	{
		$data = $this->interface->validadeToken($token);

		if ($data["token_valid"] && !$data["token_expired"])
			return $data['payload'];

		return null;
	}

	public function getDataUserLogged()
	{
		
	}
}
