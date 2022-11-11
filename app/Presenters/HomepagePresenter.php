<?php

declare(strict_types=1);

namespace App\Presenters;
use Nette\Application\UI\Form;

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
        $this->template->tasks = $this->task_repository->getAll();
	}

	protected function createComponentTaskForm(): Form
	{
		$form = new Form;
		$form->addHidden(\App\Model\TaskTable::ID);
		$form->addText(\App\Model\TaskTable::TITLE, 'Title:')            
            ->setRequired('Enter title')
            ->addRule($form::MIN_LENGTH, 'Title must be at least %d characters long', 3);
		$form->addSubmit('send', 'Submit');
		return $form;
	}

	public function addFormSucceeded(Form $form, $data): void
	{
        $this->task_repository->insert((array)$data);
        $this->flashMessage('Task was added.', 'alert-success');
        $this->redirect('Homepage:');
	}

    public function actionAdd(): void
    {        
        $form = $this["taskForm"];
		$form->onSuccess[] = [$this, 'addFormSucceeded'];
    }

    public function renderAdd(): void
    {
    }

	public function editFormSucceeded(Form $form, $data): void
	{
        // TODO: Verify task exists, check permissions, ...
        $this->task_repository->update((array)$data);
        $this->flashMessage('Task was updated.', 'alert-success');
        $this->redirect('Homepage:');
	}

    public function actionEdit(int $id):  void
    {
        $task = $this->task_repository->get($id);
        $form = $this["taskForm"];
        $form->setDefaults($task);
		$form->onSuccess[] = [$this, 'editFormSucceeded'];
    }

    public function renderEdit(int $id): void
    {
    }
}