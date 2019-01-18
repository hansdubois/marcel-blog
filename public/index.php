<?php

use Marcel\Infrastructure\CsvBlogRepository;
use Marcel\Application\RetrieveBlogData;
use Marcel\Infrastructure\JSONBlogController;
use Marcel\Infrastructure\PdoConnectionFactory;

require __DIR__  . '/../vendor/autoload.php';

//$controller = new JSONBlogController(new CsvBlogRepository(__DIR__ . '/etc/blogs.csv'));
//var_dump($controller->parseRequest($_GET));

//$query = 'SELECT * FROM blog where id = ' . $_GET['blogid'];
//var_dump($query);

$databaseConnection = new PdoConnectionFactory('mysql:host=marcel-database;dbname=blogs', 'root', '');
$retrieveBlogData = new RetrieveBlogData($databaseConnection);

//$a = $retrieveBlogData->fetchAllBlogs();
$b = $retrieveBlogData->fetchArticle(2);

var_dump($b);
