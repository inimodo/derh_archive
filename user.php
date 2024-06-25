<div class="u_content">
  <?php
  for ($index=0; $index < count($usernames); $index++) {
    echo '<a class="u_selbutton_link"  href="?user='.$index.'">
            <img class="u_selbutton" src="static_content/'.$usernames[$index].'.png">
          </a>';
  }
   ?>
</div>
