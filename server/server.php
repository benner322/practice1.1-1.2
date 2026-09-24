<?php
require '../common/header.php';
require 'commands.php';

echo "<h2>Информация о сервере</h2>";

echo "<h3>Текущая директория</h3>";
echo "<pre>" . runCommand('pwd') . "</pre>";

echo "<h3>Содержимое директории</h3>";
echo "<pre>" . runCommand('ls -la') . "</pre>";

echo "<h3>Текущие процессы</h3>";
echo "<pre>" . runCommand('ps') . "</pre>";

echo "<h3>Текущий пользователь</h3>";
echo "<pre>" . runCommand('whoami') . "</pre>";

echo "<h3>Информация о пользователе</h3>";
echo "<pre>" . runCommand('id') . "</pre>";

require '../common/footer.php';