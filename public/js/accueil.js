
$(document).ready(function() {
    

    //Initialisation AOS
    AOS.init({
        easing: 'ease',
        duration: 2000,
        once: true
    });
});



/* Slider */
const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
const slides = document.querySelectorAll('.slide');

let indexS = 0;
display(indexS);
function display (indexS) {
	slides.forEach((slide) => {
		slide.style.display = 'none';
	});
	slides[indexS].style.display = 'flex';
};

function nextSlide () {
	indexS++;
	if (indexS > slides.length - 1) {
		indexS = 0;
	}
	display(indexS);
};

function prevSlide () {
	indexS--;
	if (indexS< 0) {
		indexS = slides.length - 1;
	}
	display(indexS);
};

next.addEventListener('click', nextSlide);
prev.addEventListener('click', prevSlide);
