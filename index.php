<?php

use Marcel\Infrastructure\CsvBlogRepository;
use Marcel\Infrastructure\JSONBlogController;

require __DIR__ . '/vendor/autoload.php';

$controller = new JSONBlogController(new CsvBlogRepository(__DIR__ . '/etc/blogs.csv'));
//var_dump($controller->parseRequest($_GET));


$query = 'SELECT * FROM blog where id = ' . $_GET['blogid'];

var_dump($query);

//
//$database = new PDO('localhost', 'root', 'my-secret-pw');
//$result = $database->query($query);
//
//while($row = $result->fetch_row()) {
//    var_dump($row);
//}
//
//

//$connection = mysql_connect('localhost', 'root', 'my-secret-pw');

//$a = new PDO('localhost:blogs', 'root', 'my-secret-pw');
