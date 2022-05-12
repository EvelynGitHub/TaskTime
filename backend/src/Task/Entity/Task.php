<?php

declare(strict_types=1);

namespace TaskTime\Task\Entity;

use TaskTime\User\Entity\User;

class Task
{
    private string $uuid;
    private ?string $title;
    private ?string $description;
    private $estimatedTime;
    private User $owner;
    private User $assigners; // Pessoa a quem será atibuida a Task
    /**
     * $projetc pode ter muitas Tasks e muitos colaboradores, ele também pode ou não ter um cliente em mente
     */
    private $project;
    /**
     * $label deve ser uma indicação da atividade como, em aberto, concluido, importante, etc
     */
    private $label;

    public function __construct(
        string $uuid,
        string $title,
        string $description,
    ) {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->description = $description;
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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getEstimatedTime()
    {
        return $this->estimatedTime;
    }

    public function setEstimatedTime($estimatedTime)
    {
        $this->estimatedTime = $estimatedTime;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner(User $owner)
    {
        $this->owner = $owner;
    }

    public function getAssigners()
    {
        return $this->assigners;
    }

    public function setAssigners(User $assigners)
    {
        $this->assigners = $assigners;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project)
    {
        $this->project = $project;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }
}
