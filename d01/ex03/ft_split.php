<?php

function ft_split($str)
{
	$arr = array_filter(preg_split("/ +/", "$str"));
	sort($arr);
	return ($arr);
}

?>
