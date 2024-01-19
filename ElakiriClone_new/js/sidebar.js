let fDown = document.querySelector(".fa-chevron-down");
let fRight = document.querySelector(".fa-chevron-right");
let iconHeader = document.querySelector(".category-icon-container");
let dirHolder = document.querySelector(".direction-icon-holder");
let catLabels = Array.from(document.querySelectorAll(".cat-label"));
let catCons = Array.from(document.querySelectorAll(".cat-con"));
let prevScrollPos = window.pageYOffset || document.documentElement.scrollTop;
let scrolledUp = false;

if (isWidthOverFlown(iconHeader) || isHeightOverFlown(iconHeader)) {
  dirHolder.style.display = `flex`;
} else {
  dirHolder.style.display = `none`;
}

// for (let con of catCons) con.addEventListener('click', () => {
//     window.location.href = 'category.php';
// })

dirHide();

dirHolder.addEventListener("click", () => {
  if (window.innerWidth <= 900) {
    iconHeader.scrollLeft = iconHeader.scrollWidth;
  } else {
    iconHeader.scrollTop = iconHeader.scrollHeight;
  }
});

window.addEventListener("resize", function () {
  dirHide();
  if (isWidthOverFlown(iconHeader) | isHeightOverFlown(iconHeader)) {
    dirHolder.style.display = `flex`;
  } else {
    dirHolder.style.display = `none`;
  }
});

window.addEventListener("scroll", function () {
  if (this.window.innerWidth > 900) return;

  let currentScrollPos =
    window.pageYOffset || document.documentElement.scrollTop;

  if (currentScrollPos > prevScrollPos && !scrolledUp) {
    iconHeader.style.height = "0px";
    dirHolder.style.height = "0px";
    // catCreatePostIcon.style.bottom = `0px`;
    scrolledUp = true;
  } else if (currentScrollPos < prevScrollPos && scrolledUp) {
    iconHeader.style.height = "80px"; // Set your original iconHeader height here
    dirHolder.style.height = "80px";
    // catCreatePostIcon.style.bottom = `-80px`;
    scrolledUp = false;
  }

  prevScrollPos = currentScrollPos;
});

function isWidthOverFlown(element) {
  // console.log('width', element.scrollWidth > element.clientWidth)
  return element.scrollWidth > element.clientWidth;
}

function isHeightOverFlown(element) {
  // console.log('height', element.scrollHeight > element.clientHeight)
  return element.scrollHeight > element.clientHeight;
}

function dirHide() {
  if (window.innerWidth <= 900) {
    fDown.style.display = "none";
    fRight.style.display = "block";
  } else {
    fDown.style.display = "block";
    fRight.style.display = "none";
  }

  if (this.window.innerWidth < 900) {
    // catCreatePostIcon.style.bottom = `-80px`;
    // for (let item of catLabels) item.style.display = 'none';
    iconHeader.style.height = "80px";
    if (isWidthOverFlown(iconHeader)) {
      fRight.style.display = `flex`;
    } else fRight.style.display = `none`;
  } else {
    // catCreatePostIcon.style.bottom = `0px`;
    // for (let item of catLabels) item.style.display = 'flex';
    iconHeader.style.height = "90vh";
    if (isHeightOverFlown(iconHeader)) {
      fDown.style.display = `flex`;
    } else fDown.style.display = `none`;
  }
}

function categoryview(Cid) {
  window.location = "category.php?cid=" + Cid;
}
