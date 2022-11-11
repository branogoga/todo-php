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
		$form->addText('task_title', 'Title:')            
            ->setRequired('Enter title')
            ->addRule($form::MIN_LENGTH, 'Title must be at least %d characters long', 3);
		$form->addSubmit('send', 'Submit');
		$form->onSuccess[] = [$this, 'formSucceeded'];
		return $form;
	}

	public function formSucceeded(Form $form, $data): void
	{
        $this->task_repository->add((array)$data);
        $this->flashMessage('Task was submitted.', 'alert-success');
        $this->redirect('Homepage:');
	}

    public function renderAdd(): void
    {
    }
}