<?php
define("METHOD","GET");
include "php/data.php";
include("php/ctoken.php");

$user = preg_replace('/[^0-9\s]+/u','',$_GET['user']);
if(!isset($_GET['user']))
{
    header('Location: index.php');
    die();
}else if($user < 0 || $user >= count(USERS))
{
    header('Location: index.php');
    die();
}

$folders = scandir("./dynamic_content");
$folderPath = "./dynamic_content/".$folders[$_GET['folder']]."/";
$zipPath = "./download/".$folders[$_GET['folder']].".zip";

if(is_file($zipPath))
{
    unlink($zipPath);
}

$zip = new ZipArchive;
if($zip -> open($zipPath, ZipArchive::CREATE ) === TRUE)
{
    $dir = opendir($folderPath);
    while($file = readdir($dir)) {
        if(is_file($folderPath.$file) && !str_contains($file,"json") && !str_contains($file,"_"))
        {
            $zip -> addFile($folderPath.$file, $file);
        }
    }
    $zip ->close();
}

header('Location: '.$zipPath);
 ?>
