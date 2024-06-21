<?php

/**
 * Autoload Classes
 */
require 'vendor/autoload.php';

/**
 * Require routes file
 */
require 'app/routes.php';

\App\Helpers\Route::dispatch();