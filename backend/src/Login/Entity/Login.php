<?php

namespace TaskTime\Login\Entity;

use TaskTime\Login\Entity\ValueObject\Email;

class Login
{
    private string $uuid;
    private Email $email;
    private string $password;
    private string $type;
    private string $perl;
    private string $status;

    public function __construct(
        string $uuid = null,
        Email $email = null,
        string $password = null,
        string $type = null,
        string $perl = null,
        string $status
    ) {
        $this->uuid = $uuid;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->perl = $perl;
        $this->status = $status;
    }

    /**
     * Get the value of uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of uuid
     *
     * @return  self
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of perl
     */
    public function getPerl()
    {
        return $this->perl;
    }

    /**
     * Set the value of perl
     *
     * @return  self
     */
    public function setPerl(string $perl)
    {
        $this->perl = $perl;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }
}
