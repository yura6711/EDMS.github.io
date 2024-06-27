<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            margin-left: 400px;
            padding: 15px;
            box-sizing: border-box;
            position: relative;
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
        li, h3 {
            padding: 5px 0;
        }
        .hidden {
            display: none;
        }
        .return-button {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        .user {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
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
                <a href="#" style="text-decoration: none; color: inherit;">Информация о пользователях</a>
            </li>
            <h3 id="menu-title">Справочники</h3>
            <ul id="menu-list">
                <li>Группы</li>
                <li>Сотрудники</li>
                <li>Типы документов</li>
            </ul>
        </ul>
    </div>
    <div class="content">
        <a href="dashboard.php" class="return-button">Вернуться</a>
        <div id="userList"></div>

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

        const roleNames = {
            10: 'Оператор',
            555: 'Руководитель',
            777: 'Администратор'
        };

        fetch('get_users.php')
            .then(response => response.json())
            .then(data => {
                const userListDiv = document.getElementById('userList');
                data.forEach(user => {
                    const userDiv = document.createElement('div');
                    userDiv.classList.add('user');
                    const userID = document.createElement('p');
                    userID.textContent = `ID: ${user.id}`;
                    const username = document.createElement('p');
                    username.textContent = `Username: ${user.username}`;
                    const roleID = document.createElement('p');
                    roleID.textContent = `Роль: ${roleNames[user.role_id] || 'Неизвестно'}`;

                    userDiv.appendChild(userID);
                    userDiv.appendChild(username);
                    userDiv.appendChild(roleID);
                    userListDiv.appendChild(userDiv);
                });
            })
            .catch(error => console.error('Ошибка получения данных:', error));
    </script>
</body>
</html>
