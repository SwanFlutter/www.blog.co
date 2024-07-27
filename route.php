<?php

use Controller\RouteController;




$route = new RouteController();
$route->add('/www.blogs.co/', 'GET', 'Controller\PostController', 'index');
$route->add('/posts', 'GET', 'PostController', 'index');
$route->add('/posts/{id}', 'GET', 'PostController', 'show');
$route->add('/posts', 'POST', 'PostController', 'create');
$route->add('/posts/{id}', 'PUT', 'PostController', 'update');
$route->add('/posts/{id}', 'DELETE', 'PostController', 'destroy');