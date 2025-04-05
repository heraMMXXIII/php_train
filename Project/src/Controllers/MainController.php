<?php

namespace src\Controllers;

use src\View\View;
use src\Services\Db;
use src\Exceptions\NotFoundException;

class MainController
{
    private View $view;
    private Db $db;

    public function __construct()
    {
        // Правильный путь к шаблонам
        $templatesPath = dirname(__DIR__, 2) . '/templates';
        
        if (!is_dir($templatesPath)) {
            throw new \RuntimeException("Templates directory not found: {$templatesPath}");
        }

        $this->view = new View($templatesPath);
        $this->db = Db::getInstance();
    }

    public function sayHello(string $name): void
    {
        // Проверка существования шаблона
        if (!$this->view->templateExists('main/hello.php')) {
            throw new NotFoundException("Template main/hello.php not found");
        }

        $this->view->renderHtml('main/hello.php', ['name' => $name]);
    }

    public function sayBye(string $name): void
    {
        // Унифицированный метод render (без renderHtml2)
        if (!$this->view->templateExists('main/bye.php')) {
            throw new NotFoundException("Template main/bye.php not found");
        }

        $this->view->renderHtml('main/bye.php', ['name' => $name]);
    }
}