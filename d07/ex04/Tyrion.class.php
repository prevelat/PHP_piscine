<?php

class Tyrion {

	public function sleepwith($class) {
		$str = get_class($class);
		if ($str == "Sansa")
			print("Let's do this." . PHP_EOL);
		else if ($str == "Cersei" || $str == "Jaime")
			print("Not even if I'm drunk !" . PHP_EOL);
		return ;
	}

}

?>
