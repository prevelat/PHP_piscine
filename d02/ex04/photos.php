#!/usr/bin/php
<?php

if ($argc == 2)
{
    if(!(strstr($argv[1], "http")))
    {
        echo "Invalid Input : mising \"http\"\n";
        return ;
    }
    $ch = curl_init($argv[1]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $str = curl_exec($ch);
    preg_match_all("/<img.*?>/", $str, $arr);
    foreach ($arr[0] as $source)
    {
        preg_match("/(src=\")(.*?)(\")/", $source, $img);
        curl_close($ch);
        $file_name = strrev($img[2]);
        $i = 0;
        while ($file_name[$i] != '/')
            $i++;
        $file_name = strrev(substr($file_name, 0, $i));
        if (!($str = strstr($img[2], "http")))
        {
            if ($argv[1][strlen($argv[1]) - 1] == '/')
                while($argv[1][strlen($argv[1]) - 1] == '/')
                    $argv[1] = substr($argv[1], 0, -1);
            $i = 0;
            while($img[2][$i] == '/')
                $i++;
            if ($i != 0)
                $img[2] = substr($img[2], $i, strlen($img[2]) - $i);
            $img[2] = $argv[1]."/".$img[2];
            $ch = curl_init($img[2]);
        }
        else
            $ch = curl_init($str);
        $url = parse_url($argv[1]);
        if(!(is_dir($url["host"])))
            mkdir($url["host"]);
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_URL, $img[2]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $img[2] = curl_exec($ch);
        file_put_contents("$url[host]/$file_name", $img[2]);
    }
}
else
    echo "Invalid Input";


?>