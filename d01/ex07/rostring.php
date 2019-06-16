#!/usr/bin/php
<?php

$str = " ";
if ($argc >= 2)
{
	$str .= $argv[1];
	$str = trim($str, " ");
	$arr = array_filter(preg_split("/ +/", "$str"));
	$i = count($arr);
	$i--;
	print_r($arr);
	$n = 1;
	while ($n <= $i)
	{
		print($arr[$n]);
		$n++;
		print(" ");
	}
	print($arr[0]);
	print("\n");
}

?>
