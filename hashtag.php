<?php
define("METHOD","POST");
include "php/cors.php";
include "php/data.php";
include "php/ctoken.php";

$_POST = json_decode(file_get_contents('php://input'), true);
$fhash = explode(".",preg_replace('/[^0-9A-Za-z.\s]+/u','',$_POST['fhash']));
$op = preg_replace('/[^0-9\s]+/u','',$_POST['op']);
$folders = scandir("./dynamic_content/");
$hashpath = "./dynamic_content/".$folders[intval($fhash[0])]."/".$fhash[1];


if(!isset($_POST['fhash']) || !isset($_POST['op']))
{
  die("[]");
}

if($op == 0)
{
  $file = fopen($hashpath.".json","r");
  echo fread($file,filesize($hashpath.".json"));
  fclose($file);
}

if($op == 1)
{
  $user = preg_replace('/[^0-9\s]+/u','',$_POST['user']);
  $file = fopen($hashpath.".json","r");
  $json = json_decode(fread($file,filesize($hashpath.".json")));
  fclose($file);

  $file = fopen($hashpath.".json","w");
  array_push($json,USERS[intval($user)]);
  fwrite($file,json_encode($json));
  fclose($file);
  echo json_encode($json);
}

?>
