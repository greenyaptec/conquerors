<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require '.maintenance.php';

define("TEMPLATE_DIR", __DIR__."/app/templates");

// Let bootstrap create Dependency Injection container.
$container = require __DIR__ . '/app/bootstrap.php';

// Run application.
$container->application->run();
