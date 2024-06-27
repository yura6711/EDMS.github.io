<?php
$host = '192.144.12.16';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '123';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = pg_query_params($conn, 'SELECT * FROM users WHERE username = $1', array($username));

    if (pg_num_rows($result) > 0) {
        header('Location: index.php?message=Пользователь уже существует');
    } else {
        pg_query_params($conn, 'INSERT INTO users (username, password) VALUES ($1, $2)', array($username, $password));
        header('Location: index.php?message=Регистрация прошла успешно');
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = pg_query_params($conn, 'SELECT * FROM users WHERE username = $1 AND password = $2', array($username, $password));

    if (pg_num_rows($result) > 0) {
        session_start();
        $_SESSION['username'] = $username; // Сохраняем имя пользователя в сессии
        header('Location: dashboard.php'); // Переадресуем на личный кабинет
    } else {
        header('Location: index.php?message=Неверные учетные данные');
    }
}

pg_close($conn);
?>
