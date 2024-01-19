function loadImgFile(event) {
  let input = event.target;
  let label = input.nextElementSibling;
  let box = input.parentNode;

  box.style.backgroundImage =
    "url(" + URL.createObjectURL(input.files[0]) + ")";
  label.style.filter = "invert(0) opacity(0.5)";
}

let catName = document.querySelector(".cat-name-value");
let titleValue = document.querySelector(".input-title");
let postMedia = document.querySelector(".post-media");
let mediaFile = document.querySelector(".input-title");
// let postContent = document.querySelector("textarea");
let postContent = document.querySelector(".tectCin");

// let submitBtn = document.querySelector('.submit-btn');

let mediaFileLoaded = false;
let uploaded = false;

function loadFile(event) {
  const filesize = event.target.files[0];
  const maxSizeInBytes = 40 * 1024 * 1024; // 40MB (adjust the value as per your requirement)
  const maxSizeInMB = maxSizeInBytes / (1024 * 1024);

  if (filesize.size > maxSizeInBytes) {
    alert(
      `File size exceeds the maximum allowed limit (${maxSizeInMB} mb). Please choose a smaller file.`
    );
    event.target.value = null; // Reset the file input field
    return;
  }

  if (uploaded) return;
  // let label = input.nextElementSibling;
  let input = event.target;
  let box = input.parentNode;

  let file = input.files[0];

  mediaFile = file;

  if (file) {
    let fileReader = new FileReader();

    fileReader.onload = function (e) {
      let mediaFileCon = document.createElement("div");
      mediaFileCon.setAttribute("class", "media-file-con");

      let closeIcon = document.createElement("i");
      closeIcon.setAttribute("class", "fa-solid fa-circle-xmark media-close");

      mediaFileCon.appendChild(closeIcon);

      let mediaElement;

      if (file.type.startsWith("image/")) {
        mediaElement = document.createElement("img");
      } else if (file.type.startsWith("video/")) {
        mediaElement = document.createElement("video");
        mediaElement.setAttribute("controls", true);
      } else if (file.type.startsWith("audio/")) {
        mediaElement = document.createElement("audio");
        mediaElement.setAttribute("controls", true);
      } else {
        console.log("Invalid file type");
        return;
      }

      mediaElement.setAttribute("class", "media-file");
      mediaElement.src = e.target.result;

      mediaFileCon.appendChild(mediaElement);
      box.appendChild(mediaFileCon);

      uploaded = true;

      // label.style.fontSize = "15px";
      // label.style.right = "10px";
      // label.style.bottom = "10px";

      closeIcon.addEventListener("click", (event) => {
        // mediaFileCon.remove();
        document.querySelector(".media-file-con").remove();
        uploaded = false;
      });
    };

    fileReader.readAsDataURL(file);
  }

  // closeMediaFiles()
}

// postContent.style.display = "flex";

// submitBtn.addEventListener('click', () => {

function uplodepost(id) {
  if (postValidation()) {
    // console.log('title', titleValue.value)
    // console.log('media', mediaFile)
    // console.log("postContent", postContent.innerHTML);

    let form = new FormData();

    form.append("title", titleValue.value);
    form.append("media", mediaFile);
    form.append("postContent", postContent.innerHTML);
    form.append("cid", id);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        // alert(r.responseText);
        if (r.responseText == "uploaded successfully") {
          window.location = "home.php";
        } else {
          alert(r.responseText);
        }
      }
    };

    r.open("POST", "uplodePostprocess.php", true);
    r.send(form);
  }
}

// function uplodepost(id) {
//   if (postValidation()) {
//     let form = new FormData();

//     form.append("title", titleValue.value);
//     form.append("media", mediaFile);
//     form.append("postContent", postContent.value);
//     form.append("cid", id);

//     $.ajax({
//       type: "POST",
//       url: "uplodePostprocess.php",
//       data: form,
//       processData: false, // Important for FormData
//       contentType: false, // Important for FormData
//       success: function (response) {
//         alert(response);
//         if (response === "uploaded successfully") {
//           window.location = "home.php";
//         } else {
//           alert(response);
//         }
//       },
//       error: function (xhr, status, error) {
//         console.error("Error:", error);
//       },
//     });
//   }
// }

function postValidation() {
  let validation = true;
  if (titleValue.value == "") {
    titleValue.style.border = "1px solid red";
    validation = false;
  } else {
    titleValue.style.border = "1px solid grey";
  }

  if (!uploaded) {
    postMedia.style.border = "1px solid red";
    validation = false;
  } else {
    postMedia.style.border = "1px solid grey";
  }

  if (postContent.value == "") {
    postContent.style.border = "1px solid red";
    validation = false;
  } else {
    postContent.style.border = "1px solid grey";
  }
  return validation;
}
