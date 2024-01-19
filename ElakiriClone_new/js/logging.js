// sign up //

function signUp() {
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let username = document.getElementById("username");
  let email = document.getElementById("email");
  let password = document.getElementById("pw");
  let Repassword = document.getElementById("Rpw");

  var form = new FormData();

  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("Repassword", Repassword.value);
  form.append("username", username.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;

      if (t == "success") {
        window.location = "home.php";
        // window.location = "home.php?from=signup";
        // signMenu(signForm);
      } else {
        document.getElementById("errorView").innerHTML = t;
      }
    }
  };

  r.open("POST", "signUpProcess.php", true);
  r.send(form);
}

// sign up //

//  log in form   //

function login() {
  let email = document.getElementById("email");
  let password = document.getElementById("pw");
  let rememberMe = document.getElementById("rememberMe");

  var form = new FormData();
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("rememberMe", rememberMe.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;

      if (t == "user") {
        // document.getElementById("errorView").innerHTML = t;

        location.reload();
      } else if (t == "admin") {
        window.location = "admin/admin-Sign-in.php";
      } else {
        document.getElementById("errorView").innerHTML = t;
      }
    }
  };

  r.open("POST", "signInProcess.php", true);
  r.send(form);
}

//  log in form   //

// sign Out  //

function signOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        window.location = "home.php";
      }
    }
  };

  r.open("GET", "signOutProcess.php", true);
  r.send();
}
// sign Out  //

// reset password //

function forgotpassword() {
  let email = document.getElementById("Vemail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "Success") {
        document.getElementById("VerrorView").innerHTML = "";

        alert("Verification Code Send to your Email. Please Check the inbox");
        document.getElementById("np").removeAttribute("readonly");
        document.getElementById("rnp").removeAttribute("readonly");
        document.getElementById("vc").removeAttribute("readonly");
        document
          .getElementById("change-pass-button")
          .removeAttribute("disabled");

        document.getElementById("send-otp-button").innerText = "Re-sent OTP";
      } else {
        document.getElementById("VerrorView").innerHTML = t;
        //  alert(t);
      }
    }
  };

  r.open("GET", "FogotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function resetPassword() {
  var e = document.getElementById("Vemail");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var form = new FormData();
  form.append("e", e.value);
  form.append("np", np.value);
  form.append("rnp", rnp.value);
  form.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        alert("Password reset success");
        signOut();
        window.location = "home.php";
      } else {
        document.getElementById("VerrorView").innerHTML = text;
        //  alert(text);
      }
    }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(form);
}

// reset password //
