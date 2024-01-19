// function pageTravel(location) {
//   window.location.href = location;
// }

function verifypassword(email) {
  let em = document.getElementById("em");
  let oldpsw = document.getElementById("oldpsw");

  let fData = new FormData();

  fData.append("em", em.value);
  fData.append("oldpsw", oldpsw.value);
  fData.append("email", email);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState === 4) {
      if (r.responseText == "success") {
        let Pbutton = document.getElementById("pwchangebutton");
        let newpsw = document.getElementById("newpsw");
        let psw = document.getElementById("psw");
        let veryfybutton = document.getElementById("veryfybutton");

        em.readOnly = true;
        oldpsw.readOnly = true;
        veryfybutton.disabled = true;
        Pbutton.disabled = false;
        newpsw.readOnly = false;
        psw.readOnly = false;

        alert("enter your new password!");
      } else {
        alert(r.responseText);
      }
    }
  };

  r.open("POST", "verifypassword.php", true);
  r.send(fData);
}

function changepassword(email) {
  let newpsw = document.getElementById("newpsw");
  let psw = document.getElementById("psw");

  let formData = new FormData();

  formData.append("newpsw", newpsw.value);
  formData.append("psw", psw.value);
  formData.append("email", email);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState === 4) {
      if (r.responseText == "success") {
        alert("new password update successful!");
        location.reload();
      } else {
        alert(r.responseText);
      }
    }
  };

  r.open("POST", "changePasswordProcess.php", true);
  r.send(formData);
}
