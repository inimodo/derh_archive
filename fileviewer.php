<?php
define("METHOD","GET");
include("php/ctoken.php");

function getFileType($file)// 0=Invalid 1=Picture 2=Video
{
  include "php/data.php";
  $type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
  if(in_array($type,VALID_IMAGE_TYPE)) return 1;
  if(in_array($type,VALID_VIDEO_TYPE)) return 2;
  return 0;
}

$folders = scandir("./dynamic_content");
$accu = 0;
$id=0;

for ($index=2; $index < count($folders); $index++)
{
  $folderPath = "./dynamic_content/".$folders[$index]."/";
  $files = scandir($folderPath);

  $trueFileCount = (count($files)-2)/2;
  $displayedImages = 0;
  $colmns = array("","","");

  for ($find=0; $find < count($files) ; $find++)
  {
    $file = $folderPath.$files[$find];
    $fhash = explode(".",$files[$find])[0];
    $folderfhash = $index.".".$fhash;

    $fileType = getFileType($files[$find]);
    if($fileType == 0) continue;


    if($search != "")
    {
      $jsonfile =   $folderPath.$fhash.".json";
      $jsonfilehandle = fopen($jsonfile,"r");
      $hashtags =  json_decode(fread($jsonfilehandle,filesize($jsonfile)));
      fclose($jsonfilehandle);

      if(!in_array($search,$hashtags))continue;
    }

    $colmnIndex = $displayedImages%3;
    $displayedImages++;

    $colmns[$colmnIndex] .= '<div class="f_content_box" >';
    if($fileType == 1)//Image
    {
      $colmns[$colmnIndex]  .= '<img class="f_content" alt="'.$folderfhash.'" src="'.$file.'" id="'.$id.'c" onclick=openView('.$id.',"'.$folderfhash.'")>';
    }
    if($fileType == 2)//Video
    {
      $colmns[$colmnIndex]  .= '
      <video
          class="f_content"
          alt="'.$folderfhash.'"
          id="'.$id.'c"
          onplay=openView('.$id.',"'.$folderfhash.'")
          controls>
            <source src="'.$file.'" type="video/mp4" >
            <source src="'.$file.'" type="video/mov" >
      </video>';
    }

    $colmns[$colmnIndex]  .= "</div>";
    $id++;
  }
  // zb "10.Mallnitz_2023" -- Magic --> "Mallnitz 2023"
  $properName = str_replace("_"," ",explode(".",$folders[$index])[1]);
  echo '<div class="f_folder_header" onclick="openFolder('.$index.')">
          <h1 class="f_header_icon"><i class="fa fa-folder" id="folderico'.$index.'"></i></h1>
          <h1 class="f_header_text">'.$properName.'</h1>
          <h1 class="f_filecount" >'.$displayedImages.' <i class="fa fa-file"></i></h1>
        </div>
        <div class="f_folder" style="display:none;" id="folder'.$index.'">';
  for ($col=0; $col < count($colmns); $col++) {
    echo '<div class="f_colmn">'.$colmns[$col]."</div>";
  }
  echo "</div>";
}
 ?>
