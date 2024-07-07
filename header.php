<a href="index.php">
 <img  id="username" class="h_user" alt="<?php echo USERS[$user]; ?>" src="static_content/<?php echo USERS[$user]; ?>.png">
</a>
<?php
if(isset($_GET['search']))
{
  echo '
  <a href="index.php?user='.$user.'&token='.TOKEN.'">
    <h1 class="h_cancelsearch">
     <i class="fa fa-ban"></i> Suche nach #'.$_GET['search'].' abbrechen.
    </h1>
  </a>
  ';
}
 ?>
<a href="upload.php?user=<?php echo $user; ?>&token=<?php echo TOKEN; ?>">
 <h1 class="h_upload">
   <i class="fa fa-upload"></i>
 </h1>
</a>
