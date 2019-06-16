<?php

class Jaime {

	public function sleepwith($class) {
		$str = get_class($class);
		if ($str == "Sansa")
			print("Let's do this." . PHP_EOL);
		else if ($str == "Cersei")
			print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		else if ($str == "Tyrion")
			print("Not even if I'm drunk !" . PHP_EOL);
		return ;
	}

}

?>
