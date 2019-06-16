#!/usr/bin/php
<?php

if ($argc != 2)
{
	print("Incorrect Parameters");
	print("\n");
	return ;
}
$i = 0;
$j = strlen($argv[1]);
if ($j < 3)
{
	echo "Syntax Error\n";
	return ;
}
$str0 = " ";
if (strpos($argv[1], "-"))
	$j = strpos($argv[1], "-");
else if (strpos($argv[1], "+"))
	$j = strpos($argv[1], "+");
else if (strpos($argv[1], "/"))
	$j = strpos($argv[1], "/");
else if (strpos($argv[1], "%"))
	$j = strpos($argv[1], "%");
else if (strpos($argv[1], "*"))
	$j = strpos($argv[1], "*");
else
{
	echo "Syntax Error\n";
	return ;
}
while ($i < $j)
{
	$str0 .= $argv[1][$i];
	$i++;
}
$str1 = $argv[1][$i];
$i++;
$str2 = " ";
$j = strlen($argv[1]);
while ($i < $j)
{
	$str2 .= $argv[1][$i];
	$i++;
}
$str0 = trim($str0);
$str2 = trim($str2);
if (!(is_numeric($str0)) || !(is_numeric($str2)))
{
	echo "Syntax Error\n";
	return ;
}
switch ($str1)
{
case "+":
	echo $str0 + $str2;
	break;
case "*":
	echo $str0 * $str2;
	break;
case "-":
	echo $str0 - $str2;
	break;
case "/":
	echo $str0 / $str2;
	break;
case "%":
	echo $str0 % $str2;
	break;
}
print("\n");

?>
