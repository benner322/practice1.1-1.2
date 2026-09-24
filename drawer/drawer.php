<?php
require '../common/header.php';     
require 'shapes.php';               

$num = $_GET['num'] ?? 0;           

echo "<h2>Drawer</h2>";
echo "<p>Число: $num</p>";
drawShape((int)$num);

require '../common/footer.php';     