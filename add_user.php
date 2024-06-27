<!DOCTYPE html>
<html>
<head>
    <title>Добавить пользователя</title>
    <style>
        .btn-container {
            margin-top: 10px; /* Задаем верхний отступ между кнопками */
        }
    </style>
</head>
<body>
    <h2>Добавить пользователя</h2>
    <form action="add_user.php" method="POST">
        <label for="username">Логин пользователя:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role_id">Роль:</label><br>
        <input type="text" id="role_id" name="role_id" required><br><br>

        <label for="email">Электронная почта:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="fullname">ФИО:</label><br>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <input type="submit" value="Добавить пользователя">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = 'localhost';
        $port = '5432';
        $dbname = 'postgres';
        $user = 'postgres';
        $password = '123';

        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
        if (!$conn) {
            echo "Ошибка соединения с базой данных.";
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];

        $query = "INSERT INTO users (username, password, role_id, email, fullname)
                            VALUES ('$username', '$password', '$role_id', '$email', '$fullname')";

        $result = pg_query($conn, $query);

        if ($result) {
            echo "Пользователь успешно зарегистрирован.";
        } else {
            echo "Ошибка при регистрации пользователя.";
        }

        pg_close($conn);
    }
    ?>

    <div class="help-window">
        <h3>Справка</h3>
        <p>Значение ролей:</p>
        <p>10 - Оператор</p>
        <p>555 - Руководитель</p>
        <p>777 - Администратор</p>
    </div>
</div>
    <!-- Кнопка "Вернуться на главную" с промежутком -->
    <div class="btn-container">
        <button onclick="window.location.href = 'dashboard.php'">Вернуться на главную</button>
    </div>
</body>
</html>
