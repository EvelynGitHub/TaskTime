<?php

namespace TaskTime\Login\UseCase\SignUp;

use Exception;
use TaskTime\Login\Entity\Exceptions\InvalidEmailValue;
use TaskTime\Login\Entity\ValueObject\Email;
use TypeError;

class InputData
{
	private string $firstName;
	private string $lastName;
	private Email $email;
	private string $password;

	private function __construct(array $data)
	{
		try {
			$this->firstName = $data["firstName"];
			$this->lastName = $data["lastName"];
			$this->email = new Email($data["email"]);
			$this->setPass($data['pass'], $data["confirm_pass"]);
		} catch (InvalidEmailValue $iev) {
			throw new InvalidEmailValue($iev->getMessage());
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		} catch (TypeError $e) {
			throw new Exception("Obrigatório informar a senha!");
		} catch (\Throwable $th) {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public static function create(array $values): InputData
	{
		// 	$data["email"] = $values["email"];
		// 	$data["password"] = $values["pass"];
		return new InputData($values);
	}

	public function __get(string $name)
	{
		if (!property_exists($this, $name)) {
			throw new Exception(sprintf("Invalid SignUp Input Data Property '%s'", $name));
		}

		return $this->{$name};
	}

	private function setPass(string $pass, string $confirmPass)
	{
		if ($pass !== $confirmPass) {
			throw new Exception("As senhas informadas são diferentes.");
		}

		$this->password = $pass;
	}
}
