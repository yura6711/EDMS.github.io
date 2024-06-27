<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff; /* Цвет фона */
        }
        .menu {
            position: fixed;
            left: 0;
            top: 0;
            width: 200px;
            height: 100%;
            background: #f4f4f4;
            padding: 20px;
            border-right: 1px solid #ccc;
            transition: 0.3s;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
            text-align: center;
        }
        button {
            margin-bottom: 10px;
            border: none;
            background: none;
            font-size: 18px;
            position: fixed;
            top: 20px;
            left: 250px;
            z-index: 1;
        }
        .logout-button {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        .menu-toggle {
            position: relative;
        }
        .welcome-msg {
            text-align: right;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            padding: 5px 0;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="menu-toggle">
        <button onclick="toggleMenu()">&#9776;</button>
    </div>
    <div class="menu" id="menu">
        <h3 id="menu-title">Навигация</h3>
        <ul id="menu-list">
            <li>Документы</li>
            <li>
                <a href="manage_users.php" style="text-decoration: none; color: inherit;">Информация о пользователях</a>
            </li>
            <?php
            session_start();

            $host = 'localhost';
            $port = '5432';
            $dbname = 'postgres';
            $user = 'postgres';
            $password = '123';

            $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

            $username = $_SESSION['username'] ?? '';

            // Получение role_id для текущего пользователя
            $query = "SELECT role_id FROM users WHERE username = '$username'";
            $result = pg_query($conn, $query);
            $row = pg_fetch_assoc($result);

            $role_id = $row['role_id'] ?? '';

            // Пункты меню для разных ролей
            if ($role_id == 777) {
                echo '<li><a href="add_user.php" style="text-decoration: none; color: inherit;">Добавить пользователя</a></li>';
                echo '<li><a href="delete_user.php" style="text-decoration: none; color: inherit;">Удалить пользователя</a></li>';
            }

            pg_close($conn); // Закрыть соединение с базой данных
            ?>
        </ul>
        <h3 id="menu-title">Справочники</h3>
        <ul id="menu-list">
            <li><a href="document.php" style="text-decoration: none; color: inherit;">О документах</a></li>
            <li>Типы документов</li>
            <li>Сотрудники</li>
        </ul>
    </div>
    <div class="content">
        <h1>Добро пожаловать!</h1>
        <?php
        if(isset($_SESSION['username'])) {
            echo "<p class='welcome-msg'>Вы вошли как: " . $_SESSION['username'] . "</p>";
            echo "<a href='logout.php' class='logout-button'>Выход</a>";
        }
        ?>
    </div>
    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            var menuTitle = document.getElementById('menu-title');
            var menuList = document.getElementById('menu-list');

            if (menu.style.width === '200px') {
                menu.style.width = '0';
                menuList.classList.add('hidden');
                menuTitle.classList.add('hidden');
            } else {
                menu.style.width = '200px';
                menuList.classList.remove('hidden');
                menuTitle.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
