#!/usr/bin/php
<?php

function ascii_area($char)
{
	if (($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z'))
		return (1);
	if ($char >= '0' && $char <= '9')
		return (2);
	else
		return (3);
}

function compare($str1, $str2)
{
	$i = 0;
	while (strcasecmp($str1[$i], $str2[$i]) == 0)
		$i++;
	if (ascii_area($str1[$i]) == ascii_area($str2[$i]))
		return (strcasecmp($str1[$i], $str2[$i]));
	else
		return (ascii_area($str1[$i]) - ascii_area($str2[$i]));
}

function ft_split($str)
{
	$arr = array_filter(preg_split("/ +/", "$str"));
	usort($arr, "compare");
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
