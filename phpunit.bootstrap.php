<?php 

declare(strict_types=1);

require_once("vendor/autoload.php");
require_once("app/bootstrap.php");

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
