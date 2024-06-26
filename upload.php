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

    <link rel="icon" type="image/svg+xml" href="./icon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Hochladen</title>
  </head>
  <body>
    <form class="u_form"action="filemanager.php?user=<?php echo $user; ?>" method="post" enctype="multipart/form-data">
      <h1 class="u_text">Datein Hochladen</h1>
      <input class="u_filesel" type="file" name="files[]" multiple="multiple">

      <h1 class="u_text" style="font-size:2vh;">Bitte wähle den richtigen Ordner aus!</h1>
      <select class="u_foldersel" name="folder" >
        <?php
        $folder = scandir("dynamic_content");
        for ($index=2; $index < count($folder); $index++) {
          echo '<option  class="u_folder" value="'.$index.'">'.$folder[$index].'</option>';
        }
         ?>
      </select>
      <input class="u_upload" type="submit" value="Hochladen" name="submit">
    </form>

  </body>
</html>
