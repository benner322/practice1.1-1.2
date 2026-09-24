<?php
function drawShape($num) {
    // Разбираем число на три части битовыми операциями:
    $shape = $num & 3;              // форма:  0, 1, 2, 3
    $color = ($num >> 2) & 3;       // цвет:   0, 1, 2, 3
    $size  = ($num >> 4) & 3;       // размер: 0, 1, 2, 3

    // Переводим номера в понятные значения:
    $px = ($size + 1) * 50;                            // 50, 100, 150, 200
    $colors = ['red', 'green', 'blue', 'yellow'];      // список цветов
    $c = $colors[$color];                              // нужный цвет
    if ($shape == 0) {   // круг
        $r = $px / 2;
        echo "<svg width='$px' height='$px'><circle cx='$r' cy='$r' r='$r' fill='$c'/></svg>";
    }
    if ($shape == 1) {   // квадрат
        echo "<svg width='$px' height='$px'><rect width='$px' height='$px' fill='$c'/></svg>";
    }
    if ($shape == 2) {   // треугольник
        $h = $px / 2;
        echo "<svg width='$px' height='$px'><polygon points='$h,0 $px,$px 0,$px' fill='$c'/></svg>";
    }
    if ($shape == 3) {   // линия
        $h = $px / 2;
        echo "<svg width='$px' height='$px'><line x1='0' y1='$h' x2='$px' y2='$h' stroke='$c' stroke-width='8'/></svg>";
    }
}