<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/user.css" rel="stylesheet" type="text/css">
    <link href="css/archive.css" rel="stylesheet" type="text/css">
    <link href="css/fileviewer.css" rel="stylesheet" type="text/css">
    <title>Archive</title>
  </head>
  <body>
    <?php
    include "data.php";

    $user = preg_replace('/[^0-9\s]+/u','',$_GET['user']);
    if(!isset($_GET['user']))
    {
        include "user.php";
        die();
    }else if($user < 0 || $user >= count($usernames))
    {
        include "user.php";
        die();
    }

    include "fileviewer.php";
     ?>


  </body>
</html>
