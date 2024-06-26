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
