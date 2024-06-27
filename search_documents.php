<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск документов</title>
</head>
<body>
    <h1>Поиск документов</h1>
    <form action="search_documents.php" method="GET">
        <input type="text" name="search" placeholder="Внесите название документа">
        <button type="submit">Поиск</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search']) && !empty($_GET['search'])) {
        $search_term = $_GET['search'];

        $host = 'localhost';
        $port = '5432';
        $dbname = 'postgres';
        $user = 'postgres';
        $password = '123';

        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
        if (!$conn) {
            echo "Database connection error.";
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

        echo "<button onclick=\"window.location.href='document.php'\">Назад</button>";
    } else {
        echo "Неверный параметр ввода.";
    }
    ?>

</body>
</html>
