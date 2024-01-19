// let genPostCon = Array.from(document.querySelectorAll('.general-post-model'));


// for (let post of genPostCon) post.addEventListener('click', () => {
//     window.location.href = 'view-post.php';
// });

// document.getElementById('likedislike').addEventListener('click', function(event) {
//     event.stopPropagation(); // Stop event propagation to prevent it from reaching the main div
// });

// document.addEventListener('click', function(event) {
//     if (event.target.matches('.like-dis-con')) {
//         event.stopPropagation(); // Stop event propagation to prevent it from reaching the main div
//     }
// });


function viewpost(id) {

    window.location.href = "view-post.php?pid=" + id;
}