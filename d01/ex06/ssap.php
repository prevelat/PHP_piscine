#!/usr/bin/php
<?php

function ft_split($str)
{
	$arr = array_filter(preg_split("/ +/", "$str"));
	sort($arr);
	return ($arr);
}


$i = 1;
$str = " ";
while ($i < $argc)
{
	$str .= " ";
	$str .= $argv[$i];
	$i++;
}
$str = trim($str, " ");
$arr = ft_split($str);
foreach($arr as $index)
{
	print($index);
	print("\n");
}

?>
