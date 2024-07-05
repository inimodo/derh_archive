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
    <form id="form" class="u_form" action="filemanager.php?user=<?php echo $user; ?>&token=<?php echo TOKEN; ?>" method="post" enctype="multipart/form-data">
      <h1 class="u_text">Hochladen</h1>
      <input class="u_filesel" type="file" name="files[]" multiple="multiple">

      <i style="font-size:6vh;color:gray; float:left;" class="fa fa-folder-open"></i>
      <select onclick="updateUpload()" class="u_foldersel" name="folder" >
        <?php
        $folders = scandir("dynamic_content");
        for ($index=2; $index < count($folders); $index++) {
          $properName = str_replace("_"," ",explode(".",$folders[$index])[1]);
          echo '<option  class="u_folder" value="'.$index.'">'.$properName.'</option>';
        }
         ?>
         <option class="u_folder" selected="selected" value="-1"> Kein Ordner ausgewählt</option>
      </select>
      <h1 class="u_infotext ">max. 50MB und max. 20 Dateien</h1>
      <input class="u_upload"onclick="showLoadingscreen()" id="upload" type="submit" value="Hochladen" name="submit" disabled>
      <h1 class="u_infotext " style ="color:gray">Tipp: Lade Videos und Fotos getrennt hoch! Noch besser ist Videos einzeln hochzuladen, da per upload nur 50MB hochgeladen werden können.</h1>
      <a class="u_navigate" href="index.php?user=<?php echo $user ?>&token=<?php echo TOKEN; ?>">
        <i class="fa fa-arrow-left"></i>
      </a>
    </form>

    <div id="loading" style="display:none;" class="u_form">
      <i style="float:left; font-size:6vh;color:white;" class="fa fa-cog fa-spin"></i>
      <h1 class="u_text">Hochladen</h1>
      <h1 class="u_infotext" >Bitte habe Gedult! Das kann nun etwas dauern. Der Upload gilt nur als erfolgreich, wenn die "Fertig" Seite sich öffnet. Wenn nicht, hast du mehr als 50MB hochgeladen. </h1>
    </div>

  </body>
</html>
