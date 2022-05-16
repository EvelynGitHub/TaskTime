<?php

namespace TaskTime\User\UseCase\FindByUuid;

use Exception;
use TypeError;

class InputData
{
	private string $uuid;

	private function __construct(array $data)
	{
		try {
			$this->uuid = $data["uuid"];
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		} catch (\Throwable $th) {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public static function create(array $values): InputData
	{
		return new InputData($values);
	}

	public function __get(string $name)
	{
		if (!property_exists($this, $name)) {
			throw new Exception(sprintf("Invalid search Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}
}
