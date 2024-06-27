<!DOCTYPE html>
<html>
<head>
    <title>Поиск документов</title>
</head>
<body>
    <h2>Поиск документов</h2>
    <form action="search_documents.php" method="GET">
        <label for="search">Поиск документов:</label><br>
        <input type="text" id="search" name="search" required>
        <button type="submit">Найти</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
        $search_term = $_GET['search'];

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

        $query = "SELECT * FROM documents WHERE document_name ILIKE '%$search_term%'";
        $result = pg_query($conn, $query);

        if (!$result || pg_num_rows($result) == 0) {
            echo "Документы не найдены.";
        } else {
            echo "<ul>";
            while ($row = pg_fetch_assoc($result)) {
                echo "<li><a href='document_details.php?id={$row['document_id']}'>{$row['document_name']}</a></li>";
            }
            echo "</ul>";
        }

        pg_close($conn);
    }
    ?>

    <button onclick="window.location.href='dashboard.php'">Назад</button>

</body>
</html>
