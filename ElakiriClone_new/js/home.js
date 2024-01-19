// function pageTravel(location) {
//     window.location.href = location;
// }

function profileview(email) {
  //   alert(email);
  window.location = "user-profile.php?email=" + email;
}

let items = Array.from(document.querySelectorAll(".home-category-item"));
let contTitles = Array.from(document.querySelectorAll(".container-title"));

for (let item of items) {
  item.addEventListener("click", () => {
    pageTravel("category.php");
  });
}

contTitles.forEach((title) => {
  let childrenOfSibling = Array.from(title.nextElementSibling.children);

  childrenOfSibling.forEach((element) => {
    if (element.className == "home-page-no-post-text") {
      title.style.display = "none";
      element.style.display = "none";
    } else {
      title.style.display = "block";
      element.style.display = "grid";
    }
  });
});
