<?php
if(METHOD == "GET")
{
  $token = preg_replace('/[^A-Za-z0-9\s]+/u','',$_GET['token']);

  if(!isset($_GET['token']) || TOKEN != $token)
  {
    die("Hello. Sorry, this site is currently offline.");
  }
}
if(METHOD == "POST")
{
  $_POST = json_decode(file_get_contents('php://input'), true);
  $token = preg_replace('/[^A-Za-z0-9\s]+/u','',$_POST['token']);
  if(!isset($_POST['token']) || TOKEN != $token)
  {
    die("Hello. Sorry, this site is currently offline.");
  }
}

 ?>
