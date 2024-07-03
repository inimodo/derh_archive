<?php
function getFileType($file)// 0=Invalid 1=Picture 2=Video
{
  include "data.php";
  $type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
  if(in_array($type,$validImageType)) return 1;
  if(in_array($type,$validVideoType)) return 2;
  return 0;
}



$folders = scandir("./dynamic_content");
$accu = 0;
$id=0;
for ($index=2; $index < count($folders); $index++)
{
  $imgp = "./dynamic_content/".$folders[$index]."/";
  $cols = array("","","");
  $files = scandir($imgp);
  $truefilecount = (count($files)-2)/2;
  $colmnindex = 0;

  for ($find=0; $find < count($files) ; $find++)
  {
    $file = $imgp.$files[$find];
    $fhash = explode(".",$files[$find])[0];
    $folderfhash = $index.".".$fhash;

    $ftype = getFileType($files[$find]);
    if($ftype == 0) continue;

    if($search != "")
    {
      $jsonfile =   $imgp.$fhash.".json";
      $jsonfilehandle = fopen($jsonfile,"r");
      $hashtags =  json_decode(fread($jsonfilehandle,filesize($jsonfile)));
      fclose($jsonfilehandle);
      if(!in_array($search,$hashtags))continue;
    }

    $colmn = $colmnindex%3;
    $colmnindex++;

    $cols[$colmn] .= '<div class="f_content_box" >';
    if($ftype == 1)
    {
      $cols[$colmn]  .= '<img class="f_content" alt="'.$folderfhash.'" src="'.$file.'" id="'.$id.'c" onclick=openView('.$id.',"'.$folderfhash.'")>';
    }
    if($ftype == 2)
    {
      $cols[$colmn]  .= '
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

    $cols[$colmn]  .= "</div>";
    $id++;
  }

  $properName = str_replace("_"," ",explode(".",$folders[$index])[1]);
  echo '<div class="f_folder_header" onclick="openFolder('.$index.')">
          <h1 class="f_header_icon"><i class="fa fa-folder" id="folderico'.$index.'"></i></h1>
          <h1 class="f_header_text">'.$properName.'</h1>
          <h1 class="f_filecount" >'.$colmnindex.' <i class="fa fa-file"></i></h1>
        </div>
        <div class="f_folder" style="display:none;" id="folder'.$index.'">';
  for ($col=0; $col < count($cols); $col++) {
    echo '<div class="f_colmn">'.$cols[$col]."</div>";
  }
  echo "</div>";
}
 ?>
