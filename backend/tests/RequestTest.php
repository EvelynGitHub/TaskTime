<?php
namespace Tests;

class RequestTest
{
    public array $data = [];

    public function __construct(array $dadosRequisicao)
    {
        $this->data = $dadosRequisicao;
    }

    public function query(string $campo)
    {
        return $this->data[$campo];
    }

    public function setNewValue(string $key, $value)
    {
       $this->data[$key] = $value;
    }
}
