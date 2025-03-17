<?php

namespace src\Controllers;
use src\View\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello', ['name' => $name, 'title' => 'Страница приветствия']);
    }


    // задание 2.1 
    public function sayBye(string $name)
    {
        $data = ['name' => $name, 'title' => 'До свидания!']; 
        $this->view->renderHtml('main/bye.php', $data); 
    }


    public function main()
    {
        $articles = [
            'title' => 'Title 1',
            'text' => 'Text 1',
        ];
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

}
