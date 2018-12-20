<?php

require __DIR__ . '/vendor/autoload.php';

$repo = new \Marcel\Application\BlogRepository();
$a = $repo->fetchAllBlogs();

var_dump($a);
