<?php
    if (!$_POST["passwd"] || $_POST["submit"] != "OK" || !$_POST["login"])
    {
        echo "ERROR\n";
        return ;
    }
    if (!file_exists("./private"))
    {
        mkdir("./private");
    }
    if (file_exists("./private/passwd"))
    {
        $accs = unserialize(file_get_contents("./private/passwd"));
        foreach ($accs as $arr)
        {
            if ($arr["login"] == $_POST["login"])
            {
                echo "ERROR\n";
                return ;
            }
        }
    }
    $new_acc["login"] = $_POST["login"];
    $new_acc["passwd"] = hash("whirlpool", $_POST["passwd"]);
    $accs[] = $new_acc;
    file_put_contents("./private/passwd", serialize($accs));
    echo "OK\n";
?>
