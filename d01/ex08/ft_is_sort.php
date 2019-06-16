#!/usr/bin/php
<?php

function ft_is_sort($tab)
{
	$arr = $tab;
	sort($arr);
	$i = 0;
	$j = count($arr);
	$n = 0;
	while ($i < $j)
	{
		if ($arr[$i] != $tab[$i])
			$n++;
		$i++;
	}
	if ($n > 0)
		return (FALSE);
	else
		return (TRUE);
}

?>
