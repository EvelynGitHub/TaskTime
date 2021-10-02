<?php

namespace TaskTime\Login\Adapter;

use TaskTime\Login\UseCase\Sigin\TokenInterface;

class JWTAdapter implements TokenInterface
{

	public function generateToken(array $data): string
	{
		return "Token";
	}
}
