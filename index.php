<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/user.css" rel="stylesheet" type="text/css">
    <link href="css/archive.css" rel="stylesheet" type="text/css">
    <link href="css/fileviewer.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js/fileviewer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    echo "asdasdssssssssssss";
     ?>


  </body>
</html>
