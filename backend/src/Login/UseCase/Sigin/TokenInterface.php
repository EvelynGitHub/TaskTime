<?php

namespace TaskTime\Login\UseCase\Sigin;

interface TokenInterface
{
	public function generateToken(array $data): string;
}
