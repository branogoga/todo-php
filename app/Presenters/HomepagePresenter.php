<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\PostFacade;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private \Dibi\Connection $database;
    private \App\Model\TaskRepository $task_repository;

	public function __construct(\Dibi\Connection $database)
	{
        $this->database = $database;
        $this->task_repository = new \App\Model\DatabaseTaskRepository($this->database);
	}


	public function renderDefault(): void
	{
        if ($this->database->isConnected()) {
            $this->flashMessage("Connection to MySQL server has failed.", "alert-danger");
        } else {
            $this->flashMessage("Connected to MySQL server successfully!", "alert-success");
        }
        
        $this->template->tasks = $this->task_repository->getAll();
	}
}