function deletepost(id) {
  //   alert(id);

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      if (r.responseText == "success") {
        alert("post deleted successfully!");
        window.location = "home.php";
      } else {
        alert(r.responseText);
      }
    }
  };

  r.open("GET", "deletepost.php?id=" + id, true);
  r.send();
}
