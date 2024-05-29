<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DB", "ChinaTown");

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die("Не удалось установить соединение с БД");
@mysqli_set_charset($connection, "utf8") or die("Ошибка кодировки соединения");
?>