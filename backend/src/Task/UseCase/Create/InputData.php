<?php

namespace TaskTime\Task\UseCase\Create;

use Exception;
use TypeError;

class InputData
{
	private string $title;
	private string $description;
	private string $estimatedTime;
	private string $assignersUuid;
	private string $project;

	private function __construct(array $data)
	{
		try {
			$this->title = $data["title"];
			$this->description = $data["description"];
			$this->project = $data["project_uuid"];
			$this->estimatedTime = $data["estimated_time"] ?? null;
			$this->assignersUuid = $data["assigners_uuid"] ?? null;
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
