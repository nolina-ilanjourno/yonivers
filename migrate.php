<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Helpers\Migration;

$migration = new Migration();
$migration->migrate();
