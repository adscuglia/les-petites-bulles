// Menu burger 
let burger = document.querySelector('.menu-burger');
let navlinks = document.querySelector('.navlinks-container');

const toggleNav = e => {
    burger.classList.toggle("open")
    navlinks.classList.toggle("open")
    document.body.classList.toggle("no-scroll");
}

burger.addEventListener('click', toggleNav)