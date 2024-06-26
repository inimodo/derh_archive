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

if(!isset($_POST["submit"]) || !isset($_POST["folder"]))
{
  header('Location: index.php');
  die();
}
$folders = scandir("dynamic_content");
if($_POST["folder"] < 0 || $_POST["folder"] > count($folders)-1)
{
  header('Location: index.php');
  die();
}
$folder = $folders[$_POST["folder"]];

$filecount = count($_FILES["files"]["name"]);
for ($fi=0; $fi < $filecount; $fi++)
{
  $status = checkIfValid(
    $_FILES["files"]["name"][$fi]
  );
  if($status != 0)
  {
    printStatus($status);
    continue;
  }

  $status = upload(
    $_FILES["files"]["name"][$fi],
    $_FILES["files"]["tmp_name"][$fi]
  );
  if($status != 0)
  {
    printStatus($status);
    continue;
  }
  processFile(
    $_FILES["files"]["name"][$fi],
    $usernames[$user],
    $folder
  );
  printStatus($status);
}

function printStatus($status)
{
  echo "STATUS:".$status."<br>";
}
function processFile($fileName,$owner,$folder)
{
  $target_file = "./upload/".basename($fileName);
  $type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $hash = hash_file('md2', $target_file);
  $newName = "./dynamic_content/".$folder."/".$hash.'.'.$owner.'.'.$type;
  rename($target_file,$newName);
}
function checkIfValid($fileName)
{
  include "data.php";
  $target_file = "./upload/".basename($fileName);
  $type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if (file_exists($target_file)) return 1;
  if(!in_array($type,$validtype)) return 3;

  return 0;
}

function upload($fileName,$tempFileName)
{
  $target_file = "./upload/".basename($fileName);
  if (move_uploaded_file($tempFileName, $target_file)) return 0;
  return 4;
}

?>
</body>
</html>
