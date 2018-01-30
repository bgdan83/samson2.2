<?php

$n = 10;
$p = 53;
$arr_simple = array();
for ($i = $n; $i <= $p; $i++) {
    if (($i % 2) == 0)
        continue;
    else {
        for ($j = 3; $j < $i; $j = $j + 2) {
            if (($i % $j) == 0) {
                break;
            }
            if ($j == ($i - 2))
                $arr_simple[] = $i;
        }
    }
}
echo 'Простых чисел в заданном диапазоне: ', count($arr_simple), "\n";
$ar = array(
    array(
        'a' => 11,
        'b' => 13,
        'c' => 17
    ),
    array(
        'a' => 19,
        'b' => 23,
        'c' => 29,
    ),
    array(
        'a' => 31,
        'b' => 37,
        'c' => 41,
    ),
    array(
        'a' => 43,
        'b' => 47,
        'c' => 53,
    )
);

foreach ($ar as $a => &$v) {
    $v['s'] = (($v["a"] + $v["b"]) * $v["c"]) / 2;
}

function minimum($ar)
{
    $result = 0;
    foreach ($ar as $a) {
        if ($result > $a)
            $result = $a;
    }
    return $result;
}

function degree($number, $pow)
{
    $result = 1;
    for ($i = 0; $i < $pow; $i++) {
        $result *= $number;
    }
    return $result;
}

// f=(a*b^c+(((a/c)^b)%3)^min(a,b,c))
function calculation($a, $b, $c)
{

    $ar = array($a, $b, $c);
    $result = 0;
    $temp = 0;
    $result = $a / $c;
    $result = degree($result, $b);
    $result %= 3;
    $temp = minimum($ar);
    $result = degree($result, $temp);
    $temp = degree($b, $c);
    $temp *= $a;
    $result += $temp;
    return $result;
}

foreach ($ar as $k => &$v) {
    $v["f"] = calculation($v["a"], $v["b"], $v["c"]);
}

foreach ($ar as $k => &$v) {
    if (($v["s"] % 2) != 0) {
        $v["d"] = $v["s"];
    } else {
        $v["d"] = 0;
    }
}

echo '<table border = "1">';
for ($i = 0; $i < count($ar); $i++) {
    echo '<tr>';

    foreach ($ar[$i] as $k => $value) {
        echo '<td>' . $value . '</td>';
    }

    echo '</tr>';
}
echo '</table>';
?>