<?php

use src\Controllers\ArticleController;
use src\Controllers\CommentController;
use src\Controllers\MainController;

return [
    "~^article/create$~" => [ArticleController::class, 'create'],
    "~^article$~" => [ArticleController::class, 'store'],
    "~^article/(\d+)$~" => [ArticleController::class, 'show'],
    "~^article/(\d+)/edit$~" => [ArticleController::class, 'edit'],
    "~^article/(\d+)/update$~" => [ArticleController::class, 'update'],
    "~^article/(\d+)/delete$~" => [ArticleController::class, 'delete'],
    "~^$~" => [ArticleController::class, 'index'],
    "~^article/(\d+)/comment$~" => [CommentController::class, 'store'],
    "~^comment/(\d+)/edit$~" => [CommentController::class, 'edit'],
    "~^comment/(\d+)/update$~" => [CommentController::class, 'update'],
    "~^hello/(.*)$~" => [MainController::class, 'sayHello'],
    "~^bye/(.*)$~" => [MainController::class, 'sayBye'],
];