<?php

namespace TaskTime\Login\UseCase\SignIn;

interface TokenInterface
{
	public function generateToken(array $data): string;
}
