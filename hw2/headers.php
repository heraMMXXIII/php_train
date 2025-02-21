<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заголовки</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 50%; margin: 0 auto; }
        header, footer { text-align: center; padding: 10px; background: #f1f1f1; }
    </style>
</head>
<body>
    <header>
        <img src="../hw1/Logo_Polytech_rus_main.jpg" alt="Логотип МосПолитеха" style="height: 50px; float: left;">
        <h1>Feedback form</h1>
    </header>
    <div class="container">
        <textarea rows="10" cols="50"><?php print_r(getallheaders()); ?></textarea>
    </div>
    <footer>
        <p>Задание для самостоятельной работы</p>
    </footer>
</body>
</html>
