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

$filename = preg_replace('/[^0-9A-Za-z.\s]+/u','',$_GET['filename']);
$folder = preg_replace('/[^0-9\s]+/u','',$_GET['folder']);
$folders = scandir("./dynamic_content/");
$filePapthOld = "./dynamic_content/".$folders[intval($folder)]."/".$filename;
$filePapthNew = "./dynamic_content/".$folders[intval($folder)]."/_".$filename;
rename($filePapthOld,$filePapthNew);
header('Location: index.php?user='.$user.'&token='.TOKEN);
 ?>
