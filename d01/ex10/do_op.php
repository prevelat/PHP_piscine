#!/usr/bin/php
<?php

if ($argc != 4)
{
	print("Incorrect Parameters");
	print("\n");
	return ;
}
$argv[1] = trim($argv[1]);
$argv[2] = trim($argv[2]);
$argv[3] = trim($argv[3]);
switch ($argv[2])
{
case "+":
	echo $argv[1] + $argv[3];
	break;
case "*":
	echo $argv[1] * $argv[3];
	break;
case "-":
	echo $argv[1] - $argv[3];
	break;
case "/":
	echo $argv[1] / $argv[3];
	break;
case "%":
	echo $argv[1] % $argv[3];
	break;
}
print("\n");

?>
