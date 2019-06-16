#!/usr/bin/php
<?php

if ($argc != 2)
{
	if ($argc != 1)
		echo "Wrong Format\n";
	return ;
}
$arr = explode(" ", $argv[1]);
if (count($arr) != 5)
{
	echo "Wrong Format\n";
	return ;
}
$str = "\b([lL]undi|[mM]ardi|[mM]ercredi|[jJ]eudi|[vV]endredi|[sS]amedi|[dD]imanche)\b";
$str1 = "\b(01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|
	20|21|22|23|24|25|26|27|28|29|30|31|1|2|3|4|5|6|7|8|9)\b";
$str2 = "\b([1-9]|[1-9][0-9]|[1-9][0-9][0-9]|1[0-9][0-9][0-9]|20[01][0-9])\b";
$str3 = "\b([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])\b";
if (!(preg_match("/$str/", $arr[0])) || !(preg_match("/$str1/", $arr[1])) ||
	!(preg_match("/$str2/", $arr[3])) || !(preg_match("/$str3/", $arr[4])))
{
	echo "Wrong Format\n";
	return ;
}
switch ($arr[2])
{
case (preg_match("/[jJ]anvier/", $arr[2]) == TRUE):
	$m = 1;
	break;
case (preg_match("/[fF]evier/", $arr[2]) == TRUE):
	$m = 2;
	break;
case (preg_match("/[mM]ars/", $arr[2]) == TRUE):
	$m = 3;
	break;
case (preg_match("/[aA]vril/", $arr[2]) == TRUE):
	$m = 4;
	break;
case (preg_match("/[mM]ai/", $arr[2]) == TRUE):
	$m = 5;
	break;
case (preg_match("/[jJ]uin/", $arr[2]) == TRUE):
	$m = 6;
	break;
case (preg_match("/[jJ]uillet/", $arr[2]) == TRUE):
	$m = 7;
	break;
case (preg_match("/[aA]out/", $arr[2]) == TRUE):
	$m = 8;
	break;
case (preg_match("/[sS]eptembre/", $arr[2]) == TRUE):
	$m = 9;
	break;
case (preg_match("/[oO]ctobre/", $arr[2]) == TRUE):
	$m = 10;
	break;
case (preg_match("/[nN]ovembre/", $arr[2]) == TRUE):
	$m = "november";
	break;
case (preg_match("/[dD]ecembre/", $arr[2]) == TRUE):
	$m = 12;
	break;
default:
	echo "Wrong Format\n";
	return ;
}
date_default_timezone_set("Europe/Paris");
echo strtotime("$arr[1]-$m-$arr[3] $arr[4]");
echo "\n";

?>
