<?php
    session_start();
    if ($_GET && $_GET['login'] && $_GET['passwd'] && $_GET['submit'] == "OK")
    {
        $_SESSION['login'] = $_GET['login'];
        $_SESSION['passwd'] = $_GET['passwd'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form name="index.php" method="get">
    Username: <input type="text" name="login" autocomplete="off" value="<?php if ($_SESSION && $_SESSION['login']) echo $_SESSION['login']; ?>"><br>
    Password: <input type="password" name="passwd" value="<?php if ($_SESSION && $_SESSION['passwd']) echo $_SESSION['passwd']; ?>"><br>
    <input type="submit" name="submit" value="OK">
    </form>
</body>
</html>
