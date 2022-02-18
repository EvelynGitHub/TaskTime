<?php
namespace Tests;

class ResponseTest
{
    private $return;

    public function write(string $campo)
    {
        $this->return = $campo;
        return $campo;
    }

    public function getBody()
    {
        return $this;
    }

    public function getReturn()
    {
        return  $this->return;
    }
}
