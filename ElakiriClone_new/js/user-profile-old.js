let userPicUpload = document.querySelector(".top-logo-upload-input");

userPicUpload.addEventListener("change", (event) => {
  loadMedia(event);
});

function loadMedia(event) {
  let input = event.target;
  let label = input.nextElementSibling;
  let box = input.parentNode;

  box.style.backgroundImage =
    "url(" + URL.createObjectURL(input.files[0]) + ")";
  label.style.filter = "invert(0) opacity(0.6)";

  let picSave = document.getElementById("picSave");
  picSave.style.display = "block";
  picSave.textContent = "Save profile picture";
  picSave.addEventListener("click", verify);
}

function listNumbering(input) {
  let reportNum = Array.from(document.querySelectorAll(`.${input}`));
  let num = 1;
  for (let item of reportNum) {
    item.textContent = `${num}.`;
    num++;
  }
}

// listNumbering('post-number');

let editMode = false;

let uploadLabel = document.querySelector(".top-logo-label");
let profCon = document.querySelector(".profile-edit-container");
let btnCon = document.querySelector(".btn-con");
let editClick = document.querySelector(".edit-click");
let saveClick = document.querySelector(".save-click");
let followClick = document.querySelector(".follow-click");
let inputContainer = document.querySelector(".user-input-container");
let editContainer = document.querySelector(".edit-card");
let inputChildren = Array.from(inputContainer.children);

followClick.style.display = "inline-block";
saveClick.style.display = "none";
saveClick.style.transform = "scaleY(0)";

editClick.addEventListener("click", () => {
  if (editMode) return;
  editMode = true;
  inputContainer.style.pointerEvents = "all";
  inputChildren.forEach((input) => {
    input.style.border = `1px solid rgba(128, 128, 128)`;
  });
  editClick.style.pointerEvents = "none";
  editClick.style.opacity = 0.5;
  saveClick.style.display = "inline-block";
  saveClick.style.transform = "scaleY(1)";
});
saveClick.addEventListener("click", () => {
  if (!editMode) return;
  if (!userDetailsCheck()) return;
  editMode = false;
  inputChildren.forEach((input) => {
    input.style.border = `1px solid rgba(128, 128, 128, 0)`;
  });
  inputContainer.style.pointerEvents = "none";
  editClick.style.pointerEvents = "all";
  editClick.style.opacity = 1;
  saveClick.style.display = "none";

  savedetails();
});

function userDetailsCheck() {
  let valid = true;
  inputChildren.forEach((input) => {
    if (input.value == "") {
      input.style.border = `1px solid #ff5b5b`;
      valid = false;
    } else {
      input.style.border = `1px solid rgba(128, 128, 128)`;
    }
  });
  return valid;
}

function visiterView() {
  profCon.style.gridTemplateColumns = "1fr";
  editContainer.style.display = "none";
  followClick.style.display = "block";
  uploadLabel.style.display = "none";
}

function ownerView() {
  profCon.style.gridTemplateColumns = "1fr 2fr";
  editContainer.style.display = "flex";
  followClick.style.display = "none";
  uploadLabel.style.display = "flex";
}

visiterView();
// ownerView();

function savedetails() {
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let em = document.getElementById("em");
  let psw = document.getElementById("psw");
  let pimg = document.getElementById("top-logo");

  let formData = new FormData();
  formData.append("fname", fname.value);
  formData.append("lname", lname.value);
  formData.append("em", em.value);
  formData.append("psw", psw.value);

  if (pimg.files[0] == null || pimg.files[0] == undefined) {
    const imageHolderElement = document.querySelector(".image-holder");

    // Get the style attribute value
    const styleAttributeValue = imageHolderElement.getAttribute("style");

    // Extract the URL from the style attribute value using regex
    const urlMatch = styleAttributeValue.match(/url\(["']?([^"']*)["']?\)/);

    if (urlMatch) {
      // Get the full URL from the match
      const fullUrl = urlMatch[1];

      // Extract the image name from the URL
      const imageName = fullUrl.substring(fullUrl.lastIndexOf("/") + 1);

      formData.append("pimg", imageName);
      // console.log("Image name:", imageName);
    } else {
      alert("No  image found.");
    }
  } else {
    // alert(pimg.files[0].name);
    formData.append("pimg", pimg.files[0]);
  }
  // alert(fname.value);
  // alert(lname.value);
  //   alert(em.value);
  //   alert(psw.value);

  // alert(pimg.files[0]);
  // console.log(pimg.value);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      location.reload();
    }
  };

  r.open("POST", "profileProcess.php", true);
  r.send(formData);
}

function verify() {
  let onlyimg = document.getElementById("top-logo");

  let fData = new FormData();
  fData.append("pimg", onlyimg.files[0]);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      location.reload();
    }
  };

  r.open("POST", "profilePicuplode.php", true);
  r.send(fData);
}

function follow(email) {
  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      let followbutton = document.getElementById("picSave");
      if (r.responseText == "unfollow") {
        followbutton.innerText = "Follow";
        followbutton.className = "follow-click";
        followbutton.style.backgroundColor = "rgb(66,142,255)";
        followbutton.style.color = "white";
        // followbutton.id = "picSave";
        // followbutton.addEventListener("click", follow("<?php echo $email ?>"));
        // followbutton.onclick = null;
      } else if (r.responseText == "following") {
        followbutton.style.backgroundColor = "rgb(192, 192, 192)";
        followbutton.style.color = "black";
        followbutton.className = "follow-click";
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
