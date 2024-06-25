<?php
echo "SCHEIASDASd";


function getFileType($file)// 0=Invalid 1=Picture 2=Video
{
  $picf = array("png","PNG","JPG","jpg","JPEG","jpeg");
  $videof = array("mp4");

  $splitted = explode(".",$file);
  $fileend = $splitted[count($splitted)-1];

  if(in_array($fileend,$picf)) return 1;
  if(in_array($fileend,$videof)) return 2;
  return 0;
}



$folders = scandir("./dynamic_content");
for ($index=2; $index < count($folders); $index++)
{
  $imgp = "./dynamic_content/".$folders[$index]."/";
  $cols = array("","","");
  $files = scandir($imgp);

  echo '<div class="f_folder_header" onclick="openFolder('.$index.')">
          <h1 class="f_header_icon"><i class="fa fa-folder" id="folderico'.$index.'"></i></h1>
          <h1 class="f_header_text">'.$folders[$index].'</h1>
          <h1 class="f_header_text" style="color:gray;">('.(count($files)-2).' Datein)</h1>
        </div>
        <div class="f_folder" style="display:none;" id="folder'.$index.'">';

  for ($find=0; $find < count($files) ; $find++)
  {
    $colmn = $find%3;
    $file = $imgp.$files[$find];
    $ftype = getFileType($files[$find]);

    if($ftype == 0) continue;

    $cols[$colmn] .= '<div class="f_content_box">';

    if($ftype == 1)
    {
      $cols[$colmn]  .= '<img class="f_content" src="'.$file.'">';
    }
    if($ftype == 2)
    {
      $cols[$colmn]  .= '<video class="f_content"  controls>
         <source src="'.$file.'" type="video/mp4">
      </video>';
    }

    $cols[$colmn]  .= "</div>";
  }
  for ($col=0; $col < count($cols); $col++) {
    echo '<div class="f_colmn">'.$cols[$col]."</div>";
  }
  echo "</div>";
}
 ?>
