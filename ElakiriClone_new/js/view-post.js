let repRadios = Array.from(document.querySelectorAll(".rep-radio"));
let repTag = document.querySelector(".report-tag");
let repClose = document.querySelector(".rep-cancel");
let repFinish = document.querySelector(".rep-finish");
let repCont = document.querySelector(".report-container");
let contOpened = false;

let viewTypeDots = document.querySelector(".view-type-dots");
let viewTypeCont = document.querySelector(".view-type-cont");
let vvti = Array.from(document.querySelectorAll(".vvti"));
let vvt = Array.from(document.querySelectorAll(".vvt"));
let vvl = Array.from(document.querySelectorAll(".vvl"));

function viewTypeEnable() {
  for (let vi in vvti) {
    if (vvti[vi].checked) {
      vvt[vi].style.visibility = "visible";
    } else {
      vvt[vi].style.visibility = "hidden";
    }
  }
}

viewTypeCont.style.transform = "scaleY(0) translateY(100%)";

function viewContOC() {
  if (viewTypeCont.style.transform == "scaleY(0) translateY(100%)") {
    viewTypeCont.style.transform = "scaleY(1) translateY(100%)";
  } else {
    setTimeout(function () {
      viewTypeCont.style.transform = "scaleY(0) translateY(100%)";
    }, 250);
  }
}

viewTypeEnable();
for (let vl in vvl) {
  vvl[vl].addEventListener("click", () => {
    for (let vt of vvt) vt.style.visibility = "hidden";

    vvt[vl].style.visibility = "visible";
    viewContOC();
  });
}

viewTypeDots.addEventListener("click", () => {
  viewContOC();
});

for (let inR of repRadios) {
  inR.addEventListener("click", () => {
    repFinish.style.color = "rgb(32, 121, 255)";
    repFinish.style.pointerEvents = "all";

    for (let inRa of repRadios) {
      if (inRa.checked) inR.style.visibility = "visible";
      else inRa.style.visibility = "hidden";
    }
  });
}

repTag.addEventListener("click", () => {
  if (contOpened) return;

  repTag.style.visibility = "hidden";
  repCont.style.transform = "scaleY(1)";
  repCont.style.opacity = 1;
  contOpened = true;
});

repClose.addEventListener("click", (e) => {
  repFormClose(e);
});

repFinish.addEventListener("click", (e) => {
  repFormClose(e);
});

function repFormClose(e) {
  if (!contOpened) return;

  if (e.target.className == "rep-finish") {
    // console.log(e.target.className)
    // function for sent Report(){.....}

    let content = 0;
    let postId = 0;
    const radioButtons = document.querySelectorAll(
      'input[type="radio"][name="report-mark"]'
    );

    for (const radioButton of radioButtons) {
      if (radioButton.checked) {
        const label = document.querySelector(`label[for="${radioButton.id}"]`);
        content = label.textContent;
        postId = radioButton.value;
        // console.log("Selected input ID:", radioButton.id);
        // console.log("Selected label text:", label.textContent);
        break;
      }
    }

    let formData = new FormData();
    formData.append("content", content);
    formData.append("postId", postId);

    let r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        // alert(r.responseText);
        if (r.responseText == "success") {
          alert("report sent successfully!");
          location.reload();
        } else if (r.responseText == "removepost") {
          alert("This post has been removed!");
          window.location = "home.php";
        } else {
          console.log(r.responseText);
        }
      }
    };

    r.open("POST", "reportProcess.php", true);
    r.send(formData);

    // alert(content);
    // alert(postId);
    // let l1 = document.getElementById("l1").checked;
    // alert(l1);
  }
  repCont.style.transform = "scaleY(0)";
  repCont.style.opacity = 0;
  contOpened = false;

  for (let inR of repRadios) {
    if (inR.checked) inR.checked = false;
    inR.style.visibility = "hidden";
  }

  repTag.style.visibility = "visible";
  repFinish.style.color = "grey";
  repFinish.style.pointerEvents = "none";
}

function profileview(email) {
  //   alert(email);
  window.location = "user-profile.php?email=" + email;
}

function follow(email) {
  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      let followbutton = document.getElementById("picSave");
      if (r.responseText == "unfollow") {
        followbutton.innerText = "Follow";
        followbutton.className = "view-user-follow-btn ";
        // followbutton.id = "picSave";
        // followbutton.addEventListener("click", follow("<?php echo $email ?>"));
        // followbutton.onclick = null;
      } else if (r.responseText == "following") {
        // followbutton.style.backgroundColor = "aqua";
        followbutton.className = "view-user-follow-btn followed-btn";
        followbutton.innerText = "Followed";
        // followbutton.id = "picSave";
        // followbutton.addEventListener("click", follow("<?php echo $email ?>"));
        // followbutton.onclick = null;
      } else {
        console.log("r.responseText");
      }
    }
  };

  r.open("GET", "followProcess.php?email=" + email, true);
  r.send();
}

function viewpost(pid, view) {
  // alert(pid);
  // alert(view);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);

      if ((r.responseText = "success")) {
        location.reload();
        alert("post view change successful");
      }

      // let followbutton = document.getElementById("picSave");
      // if (r.responseText == "unfollow") {
      //   followbutton.innerText = "Follow";
      //   followbutton.className = "view-user-follow-btn ";

      // } else if (r.responseText == "following") {

      // } else {
      //   console.log("r.responseText");
      // }
    }
  };

  r.open("GET", "seepostProcess.php?pid=" + pid + "&view=" + view, true);
  r.send();
}
