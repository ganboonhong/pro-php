<?php declare (strict_types = 1);

use Migrations\Migration201911232034;

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

$injector = include ROOT_DIR . '/src/dependencies.php';

$connection = $injector->make('Doctrine\DBAL\Connection');

$migration = new Migration201911232034($connection);
$migration->migrate();

echo 'Finished running migrations' . PHP_EOL;
