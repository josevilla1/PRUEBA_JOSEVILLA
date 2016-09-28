<?php
//c:\UniServerZ\www\RestService\libros\index.php

include '../include/db.php';
include '../include/libro.php';

require '../Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/lista','getLibros');
$app->get('/detalle/:isbn','getlibro');
$app->post('/insert', 'insertLibro');
$app->delete('/borrar/:isbn','deleteLibro');

$app->run();