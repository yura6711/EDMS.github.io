<!DOCTYPE html>
<html>
<head>
    <title>Удаление пользователя</title>
</head>
<body>

<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $query_check = "SELECT * FROM users WHERE id = $id";
    $result_check = pg_query($conn, $query_check);

    if (pg_num_rows($result_check) > 0) {
        $query_delete = "DELETE FROM users WHERE id = $id";
        $result_delete = pg_query($conn, $query_delete);

        echo "Пользователь с ID $id успешно удален.";
    } else {
        echo "Пользователь с ID $id не найден.";
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['return'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<form method="post">
    <label for="id">Введите ID пользователя для удаления: </label>
    <input type="text" id="id" name="id">
    <button type="submit">Удалить</button>
</form>

<form method="post">
    <button type="submit" name="return">Вернуться на главную</button>
</form>

</body>
</html>

<?php
pg_close($conn);
?>
