require('alpinejs');

//Sticky menu
const header = document.querySelector('.sticky-bar');
const sticky = header.offsetTop;
window.onscroll = function() {
  if (window.pageYOffset > sticky) {
    header.classList.add('sticky');
  } else {
    header.classList.remove('sticky');
  }
}