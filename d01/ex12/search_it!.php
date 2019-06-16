#!/usr/bin/php
<?php

function cut($str)
{
	$wait = " ";
	$i = 0;
	while ($str[$i] != ':')
		$i++;
	$i++;
	while ($i < strlen($str))
	{
		$wait .= $str[$i];
		$i++;
	}
	return (trim($wait));
}

if ($argc <= 2)
	return ;
$i = 2;
$str = " ";
while ($i < $argc)
{
	if (strncmp($argv[1], $argv[$i], strlen($argv[1])) == 0)
		$str = cut($argv[$i]);
	$i++;
}
echo trim($str);
echo "\n";

?>
