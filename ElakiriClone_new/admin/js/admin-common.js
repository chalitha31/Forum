function blockuser(id, email) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      if (r.responseText == "User Unblocked") {
        document.getElementById("btn" + id).className = "member-block-btn";
        document.getElementById("btn" + id).innerHTML = "BLOCK";
      } else if (r.responseText == "User Blocked") {
        document.getElementById("btn" + id).className =
          "member-block-btn unbk-btn";
        document.getElementById("btn" + id).innerHTML = "UNBLOCK";
      }
    }
  };
  r.open("GET", "memberBlockUnblock.php?id=" + id + "&em=" + email, true);
  r.send();
}

function memberSearch() {
  let memberserch = document.getElementById("memberserch");

  r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("memberResult").innerHTML = r.responseText;
    }
  };

  r.open("GET", "memberSearch.php?data=" + memberserch.value, true);
  r.send();
}

function addadmin() {
  // let fName = document.getElementById("fName");
  // let lName = document.getElementById("lName");
  let aEmail = document.getElementById("aEmail");
  // alert(fName)
  // alert(lName)
  // alert(aEmail.value);
  let formData = new FormData();

  // formData.append("fname", fName.value);
  // formData.append("lname", lName.value);
  formData.append("email", aEmail.value);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      if (r.responseText == "success") {
        alert("Successfully added a new moderator");
        location.reload();
      } else {
        alert(r.responseText);
        location.reload();
      }
    }
  };

  r.open("POST", "addadminProcess.php", true);
  r.send(formData);
}

function blockAdmin(email) {
  // alert("s");
  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      if (r.responseText == "User Unblocked") {
        document.getElementById("btn" + email).className =
          "moderator-block-btn";
        document.getElementById("btn" + email).innerHTML = "BLOCK";
      } else if (r.responseText == "User Blocked") {
        document.getElementById("btn" + email).className =
          "moderator-block-btn unbk-btn";
        document.getElementById("btn" + email).innerHTML = "UNBLOCK";
      }
    }
  };

  r.open("GET", "adminBlock.php?em=" + email, true);
  r.send();
}

function loadcomment(id) {
  setInterval(function () {
    viewcomment(id);
  }, 300);
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

function postSearch() {
  let postserch = document.getElementById("postserch");
  let shortpost = document.getElementById("shortpost").value;

  let condition = 0;

  if (document.getElementById("all").checked) {
    condition = 1;
  } else if (document.getElementById("title").checked) {
    condition = 2;
  } else if (document.getElementById("cat").checked) {
    condition = 3;
  }

  // alert(condition);

  r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("postResult").innerHTML = r.responseText;
    }
  };

  r.open(
    "GET",
    "postSearch.php?data=" +
      postserch.value +
      "&condition=" +
      condition +
      "&shortpost=" +
      shortpost,
    true
  );
  r.send();
}

function catSearch(id) {
  let postserch = document.getElementById("postserch");
  let shortpost = document.getElementById("shortpost");
  // alert(id);
  if (id != 1) {
    // alert("S");
    shortpost.disabled = true;
  } else {
    shortpost.disabled = false;
  }

  r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("postResult").innerHTML = r.responseText;
    }
  };

  r.open(
    "GET",
    "postSearch.php?data=" +
      postserch.value +
      "&condition=" +
      id +
      "&shortpost=" +
      shortpost.value,
    true
  );
  r.send();
}

function viewprofile(email) {
  // alert(email);
  window.location = "user-profile.php?email=" + email;
}

function adminviewpost(id) {
  // alert("S");
  window.location.href = "admin-view-post.php?pid=" + id;
}

function removepost(id, rid) {
  // alert(id);
  // window.location.href = "admin-view-post.php?pid=" + id;
  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      if (r.responseText == "success") {
        alert("post re-list successfully!");
        location.reload();
      } else {
        alert("post remove successfully!");
        location.reload();
      }
    }
  };

  r.open("GET", "removePostProcess.php?postId=" + id + "&rid=" + rid, true);
  r.send();
}

function postsort() {
  let postserch = document.getElementById("postserch");
  let shortpost = document.getElementById("shortpost").value;

  // alert(condition);
  let condition = 0;

  if (document.getElementById("all").checked) {
    condition = 1;
  } else if (document.getElementById("title").checked) {
    condition = 2;
  } else if (document.getElementById("cat").checked) {
    condition = 3;
  }

  r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("postResult").innerHTML = r.responseText;
    }
  };

  r.open(
    "GET",
    "postSearch.php?data=" +
      postserch.value +
      "&condition=" +
      condition +
      "&shortpost=" +
      shortpost,
    true
  );
  r.send();
}
