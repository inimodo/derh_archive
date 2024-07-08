<?php
define("METHOD","POST");
include "php/cors.php";
include "php/data.php";
include "php/ctoken.php";

if(!isset($_POST['fhash']) || !isset($_POST['op']))
{
  die("[]");
}

$request_headers = getallheaders();
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS' )
{
  die("[]");
}

$_POST = json_decode(file_get_contents('php://input'), true);
$fhash = explode(".",preg_replace('/[^0-9A-Za-z.\s]+/u','',$_POST['fhash']));
$op = preg_replace('/[^0-9\s]+/u','',$_POST['op']);
$folders = scandir("./dynamic_content/");
$hashpath = "./dynamic_content/".$folders[intval($fhash[0])]."/".$fhash[1];
if(!file_exists($hashpath.".json"))die("[3]");

if($op == 0 )
{
  $text = preg_replace('/[^A-Za-z0-9äöü\s]+/u','',$_POST['text']);
  $user = preg_replace('/[^0-9\s]+/u','',$_POST['user']);
  if($text == "")die("[]");

  $newComments = '{"user":'.$user.', "date":"'.date("d.m.Y H:i").'", "text":"'.$text.'" }';

  if(file_exists($hashpath.".c.json"))
  {
    $comFile = fopen($hashpath.".c.json","r");
    $comments = json_decode(fread($comFile,filesize($hashpath.".c.json")));
    fclose($comFile);
    array_push($comments,json_decode($newComments));
    $comFile = fopen($hashpath.".c.json","w");
    fwrite($comFile,json_encode($comments));
    fclose($comFile);

  }else
  {
    $comFile = fopen($hashpath.".c.json","w");
    fwrite($comFile,"[".$newComments."]");
    fclose($comFile);
  }
  die("[]");
}

if($op == 1)
{
  if(!file_exists($hashpath.".c.json"))die("[]");
  $comFile = fopen($hashpath.".c.json","r");
  $commentsRaw = fread($comFile,filesize($hashpath.".c.json"));
  fclose($comFile);
  $comments = json_decode($commentsRaw);

  for ($index=0; $index < count($comments) ; $index++)
  {
    echo '
    <div class="v_comment">
      <img src="static_content/'.USERS[$comments[$index]->user].'.png" class="v_cicon">
      <a class="v_cauthor">'.USERS[$comments[$index]->user].'</a>
      <a class="v_ctext">'.$comments[$index]->text.'</a>
      <a class="v_cuploadinfo">'.$comments[$index]->date.'</a>
    </div>
    ';
  }
}

 ?>
