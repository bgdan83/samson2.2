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

count($arr_simple);

$ar = array(
array(
"a" => 11,
 "b" => 13,
 "c" => 17

),
 array(
"a" => 19,
 "b" => 23,
 "c" => 29

),
 array(
"a" => 31,
 "b" => 37,
 "c" => 41
),
 array(
"a" => 43,
 "b" => 47,
 "c" => 53
)
)

for ($i = 0; $i < count($ar); $i++) {

    $ar[$i]["s"] = (($ar[$i]["a"] + $ar[$i]["b"]) * $ar[$i]["c"]) / 2;
}

function minimum($ar)
{

    $result = $ar[0];

    for ($i = 1; $i < count($ar); $i++) {
        if ($result > $ar[$i])
            $result = $ar[$i];
    }

    return $result;
}

function degree($pow, $number)
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
    $result = $result ^ $b;
    $result %= 3;
    $temp = $a * $b;
    $result += $c;
    $result = $temp ^ $result;
    $temp = minimum($ar);
    $result = $result ^ $temp;


    return $result;
}

for ($i = 0; $i < count($ar); $i++) {

    $ar[$i]["f"] = calculation($ar[$i]["a"], $ar[$i]["b"], $ar[$i]["c"]);
}

for ($i = 0; $i < count($ar); $i++) {
    if (($ar[$i]["s"] % 2) != 0)
        $ar[$i]["d"] = &$ar[$i]["s"];
    else
        $ar[$i]["d"] = 0;
}

for ($i = 0; $i < count($ar); $i++) {
    echo $ar[$i]["a"];
    echo " ";
    echo $ar[$i]["b"];
    echo " ";
    echo $ar[$i]["c"];
    echo " ";
    echo $ar[$i]["s"];
    echo " ";
    echo $ar[$i]["f"];
    echo "  ";
    echo $ar[$i]["d"];
    echo "<br>";
}
?>
