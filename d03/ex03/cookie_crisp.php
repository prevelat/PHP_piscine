<?php

if ($_GET)
{
	if ($_GET["action"] == "set")
		setcookie($_GET["name"], $_GET["value"]);
	if ($_GET["action"] == "get")
	{
		$str = $_GET["name"];
		if ($str)
		{
			if ($_COOKIE[$str])
			{
				$str = $_COOKIE[$_GET["name"]];
				echo "$str\n";
			}
		}
	}
	if ($_GET["action"] == "del")
		if($_GET["name"])
			setcookie($_GET["name"], FALSE, 1);
}

?>
