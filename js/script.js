let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});


//buttons for order status//
const toggleButtons1 = document.querySelector("#toggleButton1");
const toggleButtons2 = document.querySelector("#toggleButton2");
const toggleButtons3 = document.querySelector("#toggleButton3");
const myDivs1 = document.querySelector("#myDiv1");
const myDivs2 = document.querySelector("#myDiv2");
const myDivs3 = document.querySelector("#myDiv3");

toggleButtons1.addEventListener("click", function() {
   if (myDivs1.style.display === "none") {
      myDivs2.style.display = "none";
      myDivs3.style.display = "none";
      myDivs1.style.display = "grid";
   } else {
      myDivs1.style.display = "none";
   }
   });

toggleButtons2.addEventListener("click", function() {
   if (myDivs2.style.display === "none") {
      myDivs1.style.display = "none";
      myDivs3.style.display = "none";
      myDivs2.style.display = "grid";
   } else {
      myDivs2.style.display = "none";
   }
   });

toggleButtons3.addEventListener("click", function() {
   if (myDivs3.style.display === "none") {
      myDivs1.style.display = "none";
      myDivs2.style.display = "none";
      myDivs3.style.display = "grid";
   } else {
      myDivs3.style.display = "none";
   }
   });

toggleButtons4.addEventListener("click", function() {
   if (myDivs3.style.display === "none") {
      myDivs1.style.display = "none";
      myDivs2.style.display = "none";
      myDivs3.style.display = "grid";
   } else {
      myDivs3.style.display = "none";
   }
   });

$("#hello").submit(function(event){
   loadAjax();
   event.preventDefault()
});
