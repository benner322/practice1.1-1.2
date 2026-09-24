<?php
require '../common/header.php';
require 'algorithms.php';

$str = $_GET['array'] ?? '';

if ($str == '') {
    echo "<h2>Сортировка</h2>";
    echo "<p class='error'>Параметр array не задан. Пример: <a href='?array=5,2,10,7,30'>?array=5,2,10,7,30</a></p>";
} else {
    $numbers = explode(',', $str);
    $sorted = selectionSort($numbers);

    echo "<h2>Сортировка</h2>";
    echo "<p>Исходный массив: " . $str . "</p>";
    echo "<p>Отсортированный массив: " . implode(', ', $sorted) . "</p>";
}

require '../common/footer.php';