function updateUpload()
{
  document.getElementById("upload").disabled = false;
  document.getElementById("alert").style.display="none";
}

function showLoadingscreen()
{
  document.getElementById("form").style.display="none";
  document.getElementById("loading").style.display="block";

}
