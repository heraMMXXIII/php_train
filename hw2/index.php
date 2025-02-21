<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма обратной связи</title>
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
        <form action="https://httpbin.org/post" method="post">
            <label>Имя пользователя:</label>
            <input type="text" name="username" required><br>
            
            <label>Email пользователя:</label>
            <input type="email" name="email" required><br>
            
            <label>Тип обращения:</label>
            <select name="type">
                <option value="complaint">Жалоба</option>
                <option value="suggestion">Предложение</option>
                <option value="thanks">Благодарность</option>
            </select><br>
            
            <label>Текст обращения:</label><br>
            <textarea name="message" required></textarea><br>
            
            <label>Вариант ответа:</label>
            <input type="checkbox" name="response_sms" value="sms"> SMS
            <input type="checkbox" name="response_email" value="email"> Email<br>
            
            <button type="submit">Отправить</button>
        </form>
        <br>
        <a href="headers.php">Перейти на 2 страницу</a>
    </div>
    <footer>
        <p>Задание для самостоятельной работы</p>
    </footer>
</body>
</html>
