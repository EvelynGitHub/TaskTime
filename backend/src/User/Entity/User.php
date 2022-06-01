<?php

declare(strict_types=1);

namespace TaskTime\User\Entity;

use TaskTime\Login\Entity\Login;
use TaskTime\Project\Entity\Projects;

class User
{
    private $id;
    private string $uuid;
    private ?string $firstName;
    private ?string $lastName;
    private Login $login;
    private ?Projects $projects;

    public function __construct(
        string $uuid = null,
        string $firstName = null,
        string $lastName = null,
        Login $login = null
    ) {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->login = $login;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of projects
     */
    public function getProjects(): ?Projects
    {
        return $this->projects;
    }

    /**
     * Set the value of projects
     */
    public function setProjects(Projects $projects): self
    {
        $this->projects = $projects;

        return $this;
    }
}
