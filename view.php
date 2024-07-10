<div class="v_viewermenu">
  <div class="v_controller" src="">
    <div class="v_navelement" onclick="navigate(-1)"></div>
    <div class="v_navelement" style="margin-left:50%;" onclick="navigate(+1)"></div>
    <image class="v_content" id="viewImage" alt="">
    <video class="v_content" style="z-index: 99;" id="viewVideo" controls>
       <source viewVideoSrctype="video/mp4">
    </video>
  </div>
  <div class="v_infoblock">
    <a class="v_info" id="info"></a>
  </div>

  <div class="v_htlist" id="hashtags" >
  </div>

  <div class="v_htlist" >
    <a class="v_cheader">Kommentare</a>
    <div id="comments"></div>
    <div class="v_comment">
      <textarea  type="text" id="cinput" class="v_cinput" rows="5"></textarea>
      <a class="v_cupload" id="cupload" onclick="addComment()">
        <i class="fa fa-paper-plane"></i>
      </a>
    </div>
  </div>

  <div class="v_hider" onclick="closeView()"> </div>

</div>
