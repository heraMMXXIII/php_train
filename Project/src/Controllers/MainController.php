<?php

namespace src\Controllers;
use src\View\View;

class MainController {
    private $view;
    
    public function __construct(){
        $this->view = new View(dirname(dirname(__DIR__)).'/templates');
    }
    
    public function sayHello(string $name){
        $this->view->renderHtml('main/hello', ['name' => $name]);
    }

    public function sayBye(string $name){
        $this->view->renderHtml('main/bye', ['name' => $name]);
    }
}