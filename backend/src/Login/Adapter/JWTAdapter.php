<?php

namespace TaskTime\Login\Adapter;

use TaskTime\Login\UseCase\SignIn\TokenInterface;

class JWTAdapter implements TokenInterface
{

	public function generateToken(array $data): string
	{
		return "Token";
	}


	public function validadeToken(string $token): array
	{

		return [
			"token_valid" => true,
			"token_expired" => false,
			"payload" => [
				"nome" => "Fulano",
				"status" => "Ativo",
				"type" => "A"
			]
		];
	}
}
