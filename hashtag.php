<?php
$user = preg_replace('/[^0-9A-Za-z\s]+/u','',$_GET['fhash']);
$op = preg_replace('/[^0-9\s]+/u','',$_GET['op']);

if(!isset($op) || !isset($user))
{
  die("[]");
}

 ?>
