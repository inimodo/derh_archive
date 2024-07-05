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
    <div class="v_container" id="view" style="display:none;" >
      <div class="v_controller" src="">
        <div class="v_navelement" onclick="navigate(-1)"></div>
        <div class="v_navelement" style="margin-left:50%;" onclick="navigate(+1)"></div>
        <image class="v_content" id="viewImage" alt="">
        <video class="v_content" style="z-index: 99;" id="viewVideo" controls>
           <source viewVideoSrctype="video/mp4">
        </video>
      </div>
      <a class="v_info" id="info"></a>
      <div class="v_htlist" id="hashtags" >
      </div>
      <a class="u_navigate" onclick="closeView()">
        <i class="fa fa-arrow-left"></i>
      </a>
    </div>
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

    <div  class="h_content" id="content">
      <?php
      include("fileviewer.php");
      ?>
    </div>
    <div class="h_header" id="header">
    <a href="index.php">
     <img  id="username" class="h_user" alt="<?php echo USERS[$user]; ?>" src="static_content/<?php echo USERS[$user]; ?>.png">
    </a>

    <?php
    if(isset($_GET['search']))
    {
      echo '
      <a href="index.php?user='.$user.'&token='.TOKEN.'">
        <h1 class="h_cancelsearch">
         <i class="fa fa-ban"></i> Suche nach #'.USERS[$user].' abbrechen.
        </h1>
      </a>
      ';
    }
     ?>

     <a href="upload.php?user=<?php echo $user; ?>&token=<?php echo TOKEN; ?>">
       <h1 class="h_upload">
         <i class="fa fa-upload"></i>
       </h1>
     </a>
    </div>

  </body>
</html>
