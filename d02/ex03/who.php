#!/usr/bin/php
<?php

function compare($str1, $str2)
{
    return(strcmp($str1[3], $str2[3]));
}

date_default_timezone_set('America/Los_Angeles');
$arr;
exec("w", $arr0);
$n = count($arr0) - 2;
exec("w | tail -n $n", $arr);
$i = 0;
foreach ($arr as $str)
{
    $ar[$i] = preg_split("/ +/", "$str");
    if ($ar[$i][1][0] == 's')
        $ar[$i][1] = "tty".$ar[$i][1];
    if (strlen($ar[$i][3]) == 4)
        $ar[$i][3] = "0".$ar[$i][3];
    $i++;
}
usort($ar, "compare");
$i = 0;
while ($i < count($ar))
{
    printf("%s %-9s", $ar[$i][0], $ar[$i][1]);
    echo date("M j")." ".$ar[$i][3]." \n";
    $i++;
}

?>
