<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\PostFacade;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	public function __construct()
	{
	}


	public function renderDefault(): void
	{
        $host = 'db';
        $user = 'app_user';
        $pass = 't3rceS';
        $conn = new \mysqli($host, $user, $pass);
        if ($conn->connect_error) {
            $this->flashMessage("Connection failed: " . $conn->connect_error, "alert-danger");
        } else {
            $this->flashMessage("Connected to MySQL server successfully!", "alert-success");
        }      
  
	}
}