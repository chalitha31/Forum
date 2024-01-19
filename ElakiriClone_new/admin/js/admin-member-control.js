function membersort() {
  let sortvalue = document.getElementById("shortvalue");
  //   alert(sortvalue.value);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;

      document.getElementById("memberResult").innerHTML = t;
    }
  };

  r.open("GET", "memberResultProcess.php?Cid=" + sortvalue.value, true);
  r.send();
}

window.onload = function () {
  let sortvalue = document.getElementById("shortvalue");
  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;

      document.getElementById("memberResult").innerHTML = t;
    }
  };

  r.open("GET", "memberResultProcess.php?Cid=" + sortvalue.value, true);
  r.send();
};
