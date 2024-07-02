<?php
include "data.php";
$user = preg_replace('/[^0-9\s]+/u','',$_GET['user']);
if(!isset($_GET['user']))
{
    header('Location: index.php');
    die();
}else if($user < 0 || $user >= count($usernames))
{
    header('Location: index.php');
    die();
}
 ?>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/archive.css" rel="stylesheet" type="text/css">
    <link href="css/upload.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js/upload.js"></script>
    <link rel="icon" type="image/svg+xml" href="./icon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Hochladen</title>
  </head>
  <body>
    <form id="form" class="u_form" action="filemanager.php?user=<?php echo $user; ?>" method="post" enctype="multipart/form-data">
      <h1 class="u_text">Hochladen</h1>
      <input class="u_filesel" type="file" name="files[]" multiple="multiple">

      <i style="font-size:10vw;color:gray;" class="fa fa-folder-open"></i>
      <h1 class="u_text" style="font-size:2.5vw;width: 70%;float:right;color:gray;">Vergiss nicht den richtigen Ordner auszuwählen!</h1>
      <select onclick="updateUpload()" class="u_foldersel" name="folder" >
        <?php
        $folder = scandir("dynamic_content");
        for ($index=2; $index < count($folder); $index++) {
          echo '<option  class="u_folder" value="'.$index.'">'.$folder[$index].'</option>';
        }
         ?>
         <option class="u_folder" selected="selected" value="-1"> Kein Ordner ausgewählt</option>
      </select>
      <h1 class="u_text" style="font-size:2.5vw;width: 70%;color:gray;">max. 50MB pro datei</h1>
      <input class="u_upload"onclick="showLoadingscreen()"   id="upload" type="submit" value="Hochladen" name="submit" disabled>

      <a class="u_navigate" href="index.php?user=<?php echo $user ?>">
        <i class="fa fa-arrow-left"></i>
      </a>
    </form>

    <div id="loading" style="display:none;" class="u_form">
      <i style="float:left; font-size:10vw;color:white;" class="fa fa-cog fa-spin"></i>
      <h1 class="u_text">Hochladen</h1>
      <h1 class="u_text" style="font-size:2.5vw;width: 70%;color:White;">Bitte habe Gedult! Das Hochladen kann bei vielen oder großen Dateien lange dauern. </h1>
    </div>

  </body>
</html>
