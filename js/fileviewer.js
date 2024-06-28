function openFolder(folder) {
  let displ = document.getElementById("folder"+folder).style.display;
  if(displ == "none")
  {
    document.getElementById("folderico"+folder).setAttribute('class','fa fa-folder-open');
    document.getElementById("folder"+folder).style.display = "block";
  }else
  {
    document.getElementById("folderico"+folder).setAttribute('class','fa fa-folder');
    document.getElementById("folder"+folder).style.display = "none";
  }
}


function openView(cid,fhash)
{
  document.getElementById("header").style.display = "none";
  document.getElementById("content").style.display = "none";
  document.getElementById("view").style.display = "block";

  let tag = document.getElementById(cid+"c").tagName;
  console.log(tag);
  if(tag === "IMG")
  {
    let src = document.getElementById(cid+"c").src;
    document.getElementById("viewImage").src = src;
    document.getElementById("viewImage").style.display = "block";
    document.getElementById("viewVideo").style.display = "none";
  }
  if(tag === "VIDEO")
  {
    let src = document.getElementById(cid+"c").getElementsByTagName('SOURCE')[0].src;
    document.getElementById(cid+"c").pause();

    document.getElementById("viewVideo").load();
    document.getElementById("viewVideo").play();

    document.getElementById("viewVideoSrc").src = src;
    document.getElementById("viewImage").style.display = "none";
    document.getElementById("viewVideo").style.display = "block";
  }
}

function closeView()
{
  document.getElementById("viewVideo").pause();
  document.getElementById("view").style.display = "none";
  document.getElementById("content").style.display = "block";
  document.getElementById("header").style.display = "block";
}
