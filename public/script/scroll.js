// fonction pour scroll jusqu'au main
    function move() {
        const element = document.querySelector('main')
        element.scrollIntoView({behavior: 'smooth'});
    }

 const boutton = document.querySelector('.header-bu button');

 boutton.addEventListener('click', move)
