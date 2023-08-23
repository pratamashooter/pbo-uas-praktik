<?php

namespace App\Models;
use App\Models\Task;

class TodoList
{
    protected $task;
    protected $background;
    protected $music;
    protected $description;

    public function __construct($task, $description)
    {
        $this->task = $task;
        $this->description = $description;
    }

    public function setBackground($background)
    {
        $this->background = $background;
        return $this;
    }

    public function setMusic($music)
    {
        $this->music = $music;
        return $this;
    }

    public function save()
    {
        $newTask = new Task();
        $newTask->task = $this->task;
        $newTask->bg = $this->background;
        $newTask->music = $this->music;
        $newTask->description = $this->description;
        $newTask->save();

        return $newTask;
    }
}
