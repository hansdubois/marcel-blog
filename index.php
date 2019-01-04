<?php

use Marcel\Infrastructure\CsvBlogRepository;
use Marcel\Infrastructure\JSONBlogController;

require __DIR__ . '/vendor/autoload.php';

$controller = new JSONBlogController(new CsvBlogRepository());
var_dump($controller->parseRequest($_GET));
