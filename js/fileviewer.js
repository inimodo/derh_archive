function openFolder(folder)
{
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
  updateHashtags(fhash);
  updateComments(fhash);


  document.getElementById("content").style.filter = "blur(12px)";
  document.getElementById("header").style.filter = "blur(12px)";
  document.getElementById("viewImage").alt = cid;
  document.getElementById("view").style.display = "block";
  document.getElementById("cupload").onclick = (() =>{ addComment(fhash);} )
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

function buildHeader(content,contentType)
{
  var header = {
  method: 'POST',
  mode: 'cors',
  cache: 'no-cache',
  credentials: 'same-origin',
  headers: {'Content-Type': 'application/json'},
  redirect: 'follow',
  referrerPolicy: 'no-referrer'
  }
  header.body = JSON.stringify(content)
  return header;
}

function updateHashtags(fhash)
{
  const url = new URLSearchParams(window.location.search);
  var header = buildHeader({'op':0,'fhash':fhash ,'token':url.get("token")});
  fetch("https://ini02.xyz/derh/hashtag.php",header)
    .then((response) => response.json()).then((data) =>{
      document.getElementById("hashtags").innerHtml='';
      document.getElementById("hashtags").textContent ='';

      let uploadby = data[1].toLowerCase();
      uploadby = uploadby.charAt(0).toUpperCase()+uploadby.slice(1);

      let href = "index.php?user="+url.get("user")+"&search="+data[1]+"&token="+url.get("token");
      let info = '<i class="fa fa-info"></i> Hochgeladen von <a style="color:white;" href="'+href+'">'+uploadby+"</a> am "+data[0];
      document.getElementById("info").innerHTML = info;

      let header = document.createElement("a");
      header.className="v_cheader";
      header.textContent="Im Bild";
      document.getElementById("hashtags").appendChild(header);

      for (var index = 2; index < data.length; index++)
      {
        let div = document.createElement("div");
        div.className = "v_hashtag";
        i = document.createElement("i");
        i.className = "fa fa-hashtag";
        i.style.marginRight = "1vh";
        let a = document.createElement("a");
        a.className="v_httext";
        a.appendChild(i);
        a.innerHTML  += data[index];
        a.href = "index.php?user="+url.get("user")+"&search="+data[index]+"&token="+url.get("token");
        document.getElementById("hashtags").appendChild(div).appendChild(a);
      }
      let username = document.getElementById("username").alt;

      if(!data.includes(username))
      {
        let div = document.createElement("div");
        div.className = "v_hashtag";
        let i = document.createElement("i");
        i.className = "fa fa-user-plus"
        i.style.marginRight = "1vh";
        let a = document.createElement("a");
        a.className="v_httext";
        a.appendChild(i);
        a.innerHTML  += "Mich hinzufügen!";
        a.style.color = "white";
        a.onclick= (()=>{ addUserHashtag(fhash); });
        document.getElementById("hashtags").appendChild(div).appendChild(a);
      }
    });
}

function addUserHashtag(fhash)
{
  const url = new URLSearchParams(window.location.search);
  var header = buildHeader({'op':1,'fhash':fhash , 'user':url.get("user"),'token':url.get("token")});
  fetch("https://ini02.xyz/derh/hashtag.php",header)
    .then((response) => response.json()).then((data) =>{
      updateHashtags(fhash);
    });
}

function closeView()
{
  document.getElementById("content").style.filter = "blur(0px)";
  document.getElementById("header").style.filter = "blur(0px)";
  document.getElementById("viewVideo").pause();
  document.getElementById("view").style.display = "none";
}

function updateComments(fhash)
{
  document.getElementById("comments").innerHTML = "";
  const url = new URLSearchParams(window.location.search);
  var header = buildHeader({'op':1,'fhash':fhash , 'user':url.get("user"),'token':url.get("token")});
  fetch("https://ini02.xyz/derh/comments.php",header)
    .then((response) => response.text()).then((data) =>{
      document.getElementById("comments").innerHTML=data;
    });
}
function addComment(fhash)
{
  let text = document.getElementById("cinput").value;
  const url = new URLSearchParams(window.location.search);
  var header = buildHeader({'op':0,'fhash':fhash ,'text':text , 'user':url.get("user"),'token':url.get("token")});
  fetch("https://ini02.xyz/derh/comments.php",header)
    .then((response) => response.text()).then((data) =>{
      updateComments(fhash);
      document.getElementById("cinput").value = "";
    });
}
