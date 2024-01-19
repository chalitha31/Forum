function addToBookmark(id) {
  var dynamicClass = ".bookmark" + id;
  var icon = document.querySelectorAll(dynamicClass);
  var bid = id;
  var r = new XMLHttpRequest();
  // alert(dynamicClass);
  // alert(icon.length);
  r.onreadystatechange = function () {
    if (this.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "Success") {
        icon.forEach(function (element) {
          // Perform desired actions on each element
          // element.className = "fa-solid fa-bookmark";
          element.style.color = "#1d8ae9";
          // window.location.reload();
        });
      } else if (t == "Succes2") {
        icon.forEach(function (element) {
          // Perform desired actions on each element
          // element.className = "fa-solid fa-bookmark ";
          element.style.color = "gray";
          // window.location.reload();
        });
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addTOBookmarkProcess.php?id=" + bid, true);
  r.send();
}
// function addToBookmark(id) {
//   var icon = document.getElementById("bookmark" + id);
//   var bid = id;
//   var r = new XMLHttpRequest();

//   r.onreadystatechange = function () {
//     if (this.readyState == 4) {
//       var t = r.responseText;
//       // alert(t)
//       if (t == "Success") {
//         icon.className = "fa-solid fa-bookmark";
//         icon.style.color = "#1d8ae9";
//         window.location.reload();
//       } else if (t == "Succes2") {
//         icon.className = "fa-solid fa-bookmark ";
//         icon.style.color = "gray";
//         window.location.reload();
//       } else {
//         alert(t);
//       }
//     }
//   };

//   r.open("GET", "addTOBookmarkProcess.php?id=" + bid, true);
//   r.send();
// }

function removeBookmark(id) {
  var bid = id;
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (this.readyState == 4) {
      var t = r.responseText;

      if (t == "Succes2") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addTOBookmarkProcess.php?id=" + bid, true);
  r.send();
}
