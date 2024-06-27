<!DOCTYPE html>
<html>
<head>
    <title>Система Электронного документооборота</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
            background-color: #f0f8ff; /* Цвет фона */
        }
        form {
            display: inline-block;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="text"],
        input[type="password"],
        button {
            width: 300px;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            height: 20px; /* Фиксированная высота сообщения */
        }
    </style>
</head>
<body>
    <h1>Добро пожаловать!
    Сервис Электронного Документооборота</h1>
    <form action="auth.php" method="post">
        <input type="text" name="username" placeholder="Имя пользователя" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <button type="submit" name="login">Авторизация</button>
    </form>
    <div class="message">
        <?php if(isset($_GET['message'])) { echo $_GET['message']; } ?>
    </div>
</body>
</html>
