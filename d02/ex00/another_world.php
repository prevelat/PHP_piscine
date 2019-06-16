#!/usr/bin/php
<?php

if ($argc > 1)
{
	$arr = array_filter(preg_split("/[\ \t]+/", "$argv[1]"));
	$i = 0;
	foreach($arr as $str)
	{
		if ($i != 0)
			echo " ";
		echo "$str";
		$i++;
	}
	echo "\n";
}

?>
