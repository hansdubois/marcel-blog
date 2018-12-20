<?php

require __DIR__ . '/vendor/autoload.php';

$blog = new Marcel\Domain\Blog('Hans', 'Intro', 'Content');
$blog = $blog->withImage('hans.png');

var_dump($blog);
