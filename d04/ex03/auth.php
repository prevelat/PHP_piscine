<?php

function auth($login, $passwd)
{
    $accs = unserialize(file_get_contents("../ex01/private/passwd"));
    foreach ($accs as $index => $acc)
    {
        if ($acc["login"] == $login)
        {
            if (hash("whirlpool", $passwd) == $acc["passwd"])
            {
                return (TRUE);
            }
        }
    }
    return (FALSE);
}

?>