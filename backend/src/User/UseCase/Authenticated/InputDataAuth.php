<?php

namespace TaskTime\User\UseCase\Authenticated;

use Exception;
use TypeError;

class InputDataAuth
{
	private string $uuidLogin;
	private string $uuidUser;
	private string $perfil;
	private string $active;

	private function __construct(array $data)
	{
		try {
			$this->uuidLogin = $data["uuid_login"];
			$this->uuidUser = $data["uuid_user"] ?? null;
			$this->perfil = $data["perfil"];
			$this->active = $data["active"];
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		} catch (\Throwable $th) {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public static function create(array $values): InputDataAuth
	{
		return new InputDataAuth($values);
	}

	public function __get(string $name)
	{
		if (!property_exists($this, $name)) {
			throw new Exception(sprintf("Invalid Authenticated Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}
}
