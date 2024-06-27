<?php
$document_id = $_GET['id'];
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '123';

// Установите соединение с базой данных
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

$query = "SELECT * FROM documents WHERE document_id = $document_id";
$result = pg_query($conn, $query);

if ($result) {
    $document = pg_fetch_assoc($result);
    if ($document) {
        echo "<h2>Информация о документе:</h2>";
        echo "<p>Название: {$document['document_name']}</p>";
        echo "<p>Описание: {$document['document_description']}</p>";
        // Добавьте другую информацию о документе по мере необходимости
    } else {
        echo "Документ не найден.";
    }
} else {
    echo "Ошибка при выполнении запроса к базе данных.";
}

pg_close($conn);

        echo "<button onclick=\"window.location.href='document.php'\">Назад</button>";
?>
