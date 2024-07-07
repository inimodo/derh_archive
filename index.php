<?php
define("METHOD","GET");
include("php/data.php");
include("php/ctoken.php");
 ?>

<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/user.css" rel="stylesheet" type="text/css">
    <link href="css/upload.css" rel="stylesheet" type="text/css">
    <link href="css/archive.css" rel="stylesheet" type="text/css">
    <link href="css/header.css" rel="stylesheet" type="text/css">
    <link href="css/view.css" rel="stylesheet" type="text/css">
    <link href="css/fileviewer.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/svg+xml" href="./icon.svg">
    <script language="javascript" type="text/javascript" src="js/fileviewer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Achiv</title>
  </head>
  <body>
    <?php
    $user = preg_replace('/[^0-9\s]+/u','',$_GET['user']);
    $search = preg_replace('/[^A-Za-z\s]+/u','',$_GET['search']);
    if(!isset($_GET['search']))
    {
      $search = "";
    }
    if(!isset($_GET['user']))
    {
        include("user.php");
        die();
    }else if($user < 0 || $user >= count(USERS))
    {
        include("user.php");
        die();
    }
    ?>

    <div class="v_container" id="view" style="display:none;" >
      <?php
        include("view.php");
       ?>
    </div>

    <div  class="h_content" id="content">
      <?php
      include("content.php");
      ?>
    </div>

    <div class="h_header" id="header">
      <?php
        include("header.php");
       ?>
    </div>

  </body>
</html>
