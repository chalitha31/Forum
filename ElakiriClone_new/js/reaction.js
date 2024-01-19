function sendcomment(email, pid) {
  let comment = document.getElementById("comment");

  let f = new FormData();

  f.append("comment", comment.value);
  f.append("email", email);
  f.append("pid", pid);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      if (r.responseText == "success") {
        comment.value = "";
        // alert(r.responseText);
        // location.reload();
        // document.getElementById("commntTime").innerHTML = "just now";
      } else {
        alert(r.responseText);
      }
    }
  };

  r.open("POST", "commentProcess.php", true);
  r.send(f);
}

function nousercomment() {
  alert("Sign in first");
}

function like(email, pid, ststus) {
  let likeb = document.getElementById("likeb");
  let dislikeb = document.getElementById("dislikeb");
  // alert(ststus)
  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      if (r.responseText == "like") {
        // alert(r.responseText);
        // location.reload();

        likeb.className = "likedefault fa-solid fa-thumbs-up like";
        dislikeb.className = "likedefault fa-solid fa-thumbs-down ";
      } else if (r.responseText == "dislike") {
        likeb.className = "likedefault fa-solid fa-thumbs-up ";
        dislikeb.className = "likedefault fa-solid fa-thumbs-down dislike";
      } else if (r.responseText == "removelike") {
        likeb.className = "likedefault fa-solid fa-thumbs-up ";
        dislikeb.className = "likedefault fa-solid fa-thumbs-down ";
      }
      likedislikecount(pid);
    }
  };

  r.open(
    "GET",
    "likeProcess.php?pid=" + pid + "&email=" + email + "&ststus=" + ststus,
    true
  );
  r.send();
}

function likedislikecount(id) {
  let likec = document.getElementById("like-count");
  let Dislikec = document.getElementById("dislike-count");

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let text = r.responseText;
      let object2 = JSON.parse(text);
      likec.innerHTML = "<span>" + object2.likec + "</span>";
      Dislikec.innerHTML = "<span>" + object2.dislc + "</span>";
    }
  };

  r.open("GET", "postlikecount.php?pid=" + id, true);
  r.send();
}

// function loadcomment(id) {
//   setInterval(viewcomment(id), 500);
// }

function loadcomment(id) {
  setInterval(function () {
    viewcomment(id);
  }, 500);
}

function viewcomment(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      document.getElementById("loadcomment").innerHTML = text;
    }
  };

  r.open("GET", "loadcomment.php?pid=" + id, true);
  r.send();
}
