<?php

declare(strict_types=1);

namespace TaskTime\Project\Entity;

use TaskTime\Task\Entity\Tasks;

class Project
{
    private $owner;
    private string $title;
    private string $description;
    private Tasks $tasks;


    /**
     * Get the value of owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     */
    public function setOwner($owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of tasks
     */
    public function getTasks(): Tasks
    {
        return $this->tasks;
    }

    /**
     * Set the value of tasks
     */
    public function setTasks(Tasks $tasks): self
    {
        $this->tasks = $tasks;

        return $this;
    }
}
