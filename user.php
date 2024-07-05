<div class="u_content">
  <?php
  for ($index=0; $index < count(USERS); $index++) {
    echo '<a class="u_selbutton_link"  href="?user='.$index.'&token='.TOKEN.'">
            <img class="u_selbutton" src="static_content/'.USERS[$index].'.png">
          </a>';
  }
   ?>
</div>
