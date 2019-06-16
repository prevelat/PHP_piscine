<?php
    if (!$_POST || !$_POST["newpw"] || !$_POST["oldpw"] || $_POST["submit"] != "OK" || !$_POST["login"])
    {
        echo "ERROR\n";
        return ;
    }
    $accs = unserialize(file_get_contents("../ex01/private/passwd"));
    foreach ($accs as $index => $acc)
    {
        if ($acc["login"] == $_POST["login"])
        {
            $pass = hash("whirlpool", $_POST["oldpw"]);
            if ($pass != $acc["passwd"])
            {
                echo "ERROR\n";
                return ;
            }
            else
            {
                $accs[$index]["passwd"] = hash("whirlpool", $_POST["newpw"]);
            }
        }
        else
        {
            echo "ERROR\n";
            return ;
        }
    }
    file_put_contents("../ex01/private/passwd", serialize($accs));
    echo "OK\n";
?>