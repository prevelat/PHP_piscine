#!/usr/bin/php
<?php

while (1)
{
	print("Enter a number ");
	$line = trim(fgets(STDIN));
	if (!(feof(STDIN)))
	{
		if(!(is_numeric($line)))
			print("'$line' is not a number\n");
		else
		{
			if ($line % 2 == 0)
				print("The number $line is even\n");
			else
				print("The number $line is odd\n");
		}
	}
	else
	{
		echo "^D\n";
		return ;
	}
}

?>
