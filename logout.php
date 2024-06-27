<?php
// Разрушить сессию, чтобы выйти из учетной записи
session_start();
session_unset();
session_destroy();

header('Location: index.php');
exit;
?>
