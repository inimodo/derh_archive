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

function navigate(step)
{
  document.getElementById("viewVideo").pause();
  let cid = parseInt(document.getElementById("viewImage").alt) + step;
  let fhash = document.getElementById(cid+"c").alt;
  openView(cid,fhash);
}

function openView(cid,fhash)
{
  document.getElementById("viewImage").alt = cid;
  document.getElementById("view").style.display = "block";

  let tag = document.getElementById(cid+"c").tagName;
  if(tag === "IMG")
  {
    document.getElementById("viewImage").src = document.getElementById(cid+"c").src;
    document.getElementById("viewImage").style.display = "block";
    document.getElementById("viewVideo").style.display = "none";
  }
  if(tag === "VIDEO")
  {
    let src = document.getElementById(cid+"c").getElementsByTagName('SOURCE')[0].src;
    document.getElementById(cid+"c").pause();

    document.getElementById("viewVideo").load();
    document.getElementById("viewVideo").play();

    document.getElementById("viewVideo").getElementsByTagName('SOURCE')[0].src = src;
    document.getElementById("viewImage").style.display = "none";
    document.getElementById("viewVideo").style.display = "block";
  }
}

function closeView()
{
  document.getElementById("viewVideo").pause();
  document.getElementById("view").style.display = "none";
}
