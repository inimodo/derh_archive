<?php
function getFileType($file)// 0=Invalid 1=Picture 2=Video
{
  $picf = array("png","PNG","JPG","jpg","JPEG","jpeg");
  $videof = array('mp4','mov','wmv','wav');

  $splitted = explode(".",$file);
  $fileend = $splitted[count($splitted)-1];

  if(in_array($fileend,$picf)) return 1;
  if(in_array($fileend,$videof)) return 2;
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
      </video>';
    }

    $cols[$colmn]  .= "</div>";
    $id++;
  }

  echo '<div class="f_folder_header" onclick="openFolder('.$index.')">
          <h1 class="f_header_icon"><i class="fa fa-folder" id="folderico'.$index.'"></i></h1>
          <h1 class="f_header_text">'.$folders[$index].'</h1>
          <h1 class="f_filecount" >'.$colmnindex.' Dateien</h1>
        </div>
        <div class="f_folder" style="display:none;" id="folder'.$index.'">';
  for ($col=0; $col < count($cols); $col++) {
    echo '<div class="f_colmn">'.$cols[$col]."</div>";
  }
  echo "</div>";
}
 ?>
