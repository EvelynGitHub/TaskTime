<?php

namespace TaskTime\Project\UseCase\Create;

use Exception;
use TaskTime\User\UseCase\Authenticated\InputDataAuth;
use TypeError;

class InputData
{
	public string $title;
	public string $description;
	public string $estimatedTime;
	public string $assignersUuid;
	public string $project;
	public InputDataAuth $credentials;

	private function __construct(array $data)
	{
		try {
			$this->title = $data["title"];
			$this->description = $data["description"];
			$this->project = $data["project_uuid"];
			$this->estimatedTime = $data["estimated_time"] ?? null;
			$this->assignersUuid = $data["assigners_uuid"] ?? null;
			$this->credentials = InputDataAuth::create($data["credentials"]);
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
			throw new Exception(sprintf("Invalid Create Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}
}
