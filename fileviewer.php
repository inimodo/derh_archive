<?php
$folders = scandir("./dynamic_content");

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

for ($index=2; $index < count($folders); $index++)
{
  echo '<h1 class="f_header">'.$folders[$index].'</h1> <div class="f_folder" id="'.$folders[$index].'">';
  $imgp = "./dynamic_content/".$folders[$index]."/";
  $files = scandir($imgp);
  for ($find=0; $find < count($files) ; $find++)
  {
    $ftype = getFileType($files[$find]);
    if($ftype == 0) continue;
    if($ftype == 1)
    {
      echo '<img class="f_image" src="'.$imgp.$files[$find].'">';
    }
    if($ftype == 2)
    {
      echo '<video class="f_image" controls>
         <source src="'.$imgp.$files[$find].'" type="video/mp4">
      </video>';
    }
  }
  echo "</div>";
}
 ?>
