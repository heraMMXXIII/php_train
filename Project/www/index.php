<?php  
    spl_autoload_register(function(string $className){
        require_once dirname(__DIR__).'\\'.$className.'.php';
    });
    $controller = new src\Controllers\MainController();
    if (isset($_GET['name']) && !empty($_GET['name'])){
        $controller->sayHello($_GET['name']);
    }else{
        $controller->main();
    }

    $user = new src\Models\Users\User('Vadim');
    $article = new src\Models\Articles\Article('title', 'text', $user);
    // var_dump($controller);
?>