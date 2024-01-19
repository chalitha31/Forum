function delay(ms) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("");
    }, ms);
  });
}

function pageTravel(location) {
  window.location.href = location;
}

document.addEventListener("DOMContentLoaded", () => {
  let navDrop = document.querySelector(".header-dropdown-container");

  let hambMenu = document.querySelector(".hamb-menu");

  let signbtn = document.querySelector(".header-sign-text");
  let forgotbtn = document.querySelector(".fog");

  let signForm = document.querySelector(".header-sign-form");
  let forgotForm = document.querySelector(".forget-form-container");

  let formClose = document.querySelector(".form-close");
  let forgotFormClose = document.querySelector(".forgot-form-close");

  signForm.style.opacity = 0;
  forgotForm.style.opacity = 0;

  let creatPostIcon = document.querySelector(".create-post-icon");
  let dropCat = document.querySelector(".drop-cat");
  let dropCatClose = document.querySelector(".drop-cat-close");

  // console.log(creatPostIcon)
  // console.log(dropCat)
  // let dropCatIcons = Array.from(document.querySelectorAll('.drop-category-item'));

  dropCat.style.transform = `scale(0)`;
  dropCat.style.opacity = 0;

  // for (let icon of dropCatIcons) {
  //     icon.addEventListener('click', () => { pageTravel('create-post-page.php') })
  // }

  // signbtn.addEventListener("click", () => {
  //   signMenu(signForm);
  // });
  signbtn.addEventListener("click", () => {
    console.log(signbtn.classList.length);
    if (signbtn.classList.length == 1) signMenu(signForm);
  });
  forgotbtn.addEventListener("click", () => {
    signMenu(forgotForm);
  });
  formClose.addEventListener("click", () => {
    signMenu(signForm);
  });
  forgotFormClose.addEventListener("click", () => {
    signMenu(forgotForm);
  });

  // async function dropCatF() {
  //     let steps = 10;
  //     let DropDSize = 0;
  //     if (dropCat.style.opacity == 0) {
  //         for (let i = 0; i < steps; i++) {
  //             dropCat.style.transform = `scale(${DropDSize})`;
  //             dropCat.style.opacity = DropDSize;
  //             DropDSize += 1 / steps;
  //             await delay(1);
  //         }
  //         dropCat.style.transform = `scale(1)`;
  //         dropCat.style.opacity = 1;

  //         creatPostIcon.style.transform = `scale(0) translateX(20%) translateY(120%)`;
  //         creatPostIcon.style.opacity = 0;
  //     }
  //     else {
  //         for (let i = 0; i < steps; i++) {
  //             dropCat.style.transform = `scale(${DropDSize})`;
  //             dropCat.style.opacity = DropDSize;
  //             DropDSize -= 1 / steps;
  //             await delay(1);
  //         }
  //         dropCat.style.transform = `scale(0)`;
  //         dropCat.style.opacity = 0;

  //         creatPostIcon.style.transform = `scale(1) translateX(20%) translateY(120%)`;
  //         creatPostIcon.style.opacity = 1;
  //     }
  // }
  async function dropCatF() {
    if (dropCat.style.opacity == 0) {
      dropCat.style.transform = `scale(1)`;
      dropCat.style.opacity = 1;

      creatPostIcon.style.transform = `scale(0) translateX(20%) translateY(120%)`;
      creatPostIcon.style.opacity = 0;
    } else {
      dropCat.style.transform = `scale(0)`;
      dropCat.style.opacity = 0;

      creatPostIcon.style.transform = `scale(1) translateX(20%) translateY(120%)`;
      creatPostIcon.style.opacity = 1;
    }
  }

  creatPostIcon.addEventListener("click", () => {
    dropCatF();
  });
  dropCatClose.addEventListener("click", () => {
    dropCatF();
  });

  async function signMenu(element) {
    let steps = 30;
    let navOp = 0;
    if (element == forgotForm) {
      navOp = 1;
      for (let i = 0; i < steps; i++) {
        signForm.style.opacity = `${navOp}`;
        navOp -= 1 / steps;
        await delay(1);
      }
      signForm.style.opacity = 0;
      signForm.style.display = "none";
    }
    if (element.style.opacity == 0) {
      element.style.display = "flex";
      // console.log(2)
      for (let i = 0; i < steps; i++) {
        element.style.opacity = `${navOp}`;
        navOp += 1 / steps;
        await delay(1);
      }
      element.style.opacity = 1;
    } else if (element.style.opacity == 1) {
      // console.log(2)
      navOp = 1;
      for (let i = 0; i < steps; i++) {
        element.style.opacity = `${navOp}`;
        navOp -= 1 / steps;
        await delay(1);
      }
      element.style.opacity = 0;
      element.style.display = "none";
    }
  }

  navDrop.style.transform = `scale(0)`;
  navDrop.style.opacity = 0;

  console.log();

  hambMenu.addEventListener("click", () => {
    navMenu();
  });

  async function navMenu() {
    let steps = 10;
    let DropDSize = 0;
    if (navDrop.style.opacity == 0) {
      for (let i = 0; i < steps; i++) {
        navDrop.style.transform = `scale(${DropDSize})`;
        navDrop.style.opacity = DropDSize;
        DropDSize += 1 / steps;
        await delay(1);
      }
      navDrop.style.transform = `scale(1)`;
      navDrop.style.opacity = 1;
    } else {
      for (let i = 0; i < steps; i++) {
        navDrop.style.transform = `scale(${DropDSize})`;
        navDrop.style.opacity = DropDSize;
        DropDSize -= 1 / steps;
        await delay(1);
      }
      navDrop.style.transform = `scale(0)`;
      navDrop.style.opacity = 0;
    }
  }
});

let slc = document.querySelector(".cat-selector");
let srch = document.querySelector(".header-searchbar");
let srchCon = document.querySelector(".header-searchbar-con");
let styles = window.getComputedStyle(srch);
let srchWidth = parseFloat(styles.width);

srchWidth = srchCon.offsetWidth - slc.offsetWidth - 10;
srch.style.width = `${srchWidth}px`;

window.addEventListener("resize", () => {
  srchWidth = srchCon.offsetWidth - slc.offsetWidth - 10;
  srch.style.width = `${srchWidth}px`;
});

function createPost(id) {
  window.location = "create-post-page.php?id=" + id;
}

function search(cat) {
  let serchC = document.getElementById("serchC");
  let searchtect = document.getElementById("searchtect");
  // alert(cat);

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      // alert(r.responseText);
      // if (r.responseText == "success") {
      // alert(r.responseText);
      // location.reload();
      document.getElementById("result").innerHTML = r.responseText;
      // }
    }
  };

  r.open(
    "GET",
    "homeSerachProcess.php?serchC=" +
      serchC.value +
      "&searchtect=" +
      searchtect.value +
      "&cat=" +
      cat,
    true
  );
  r.send();
}

function bookmrk() {
  window.location = "bookmark.php";
}
function notification() {
  window.location = "notification.php";
}

function userprofile(email) {
  //   alert(email);
  window.location = "user-profile.php?email=" + email;
}

function adminlog() {
  window.location = "admin/admin-Sign-in.php";
}
function privacy(email) {
  window.location = "privacy.php?email=" + email;
}
