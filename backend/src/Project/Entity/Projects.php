<?php

declare(strict_types=1);

namespace TaskTime\Project\Entity;

class Projects implements \Countable, \Iterator
{
    private int $position = 0;
    private array $projects;

    public function add(Project $project)
    {
        $this->projects[] = $project;
    }

    public function count(): int
    {
        return count($this->projects);
    }

    public function __construct()
    {
        $this->position = 0;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->projects[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->projects[$this->position]);
    }
}
