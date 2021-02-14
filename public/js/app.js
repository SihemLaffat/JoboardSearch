//JQuery
$(document).ready(function() {
    
    //Smooth scroll down
    $('nav a[href*="#"]').on('click', function () {
        $('html, body').animate( {
            scrollTop: $($(this).attr('href')).offset().top - 100
        }, 2000);
    });


    //Initialisation AOS
    AOS.init({
        easing: 'ease',
        duration: 2000,
        once: true
    });
});




var ul = document.getElementsByTagName('ul')
var choice = document.getElementsByClassName('choice');
var dragItem = null;

for (var i of ul) {
    i.addEventListener('dragstart', dragStart);
    i.addEventListener('dragend', dragEnd);
}

function dragStart() {
    dragItem = this;
    setTimout(()=>this.style.display ='none', 0);
}
function dragEnd() {
    setTimout(()=>this.style.display = 'block', 0);
    dragItem = null;

}

for (j of choice) {
    j.addEventListener('dragover', DragOver);
    j.addEventListener('dragenter', dragEnter);
    j.addEventListener('dragleave', dragLeave);
    j.addEventListener('drop', Drop);
}

function Drop() {
    this.append(dragItem);

}
function DragOver(e) {
    e.preventDefault();
    
}function dragEnter(e) {
    e.preventDefault();
    
}
function dragLeave() {
    e.preventDefault();
    
}


/* Slider */
const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
const slides = document.querySelectorAll('.slide');

let index = 0;
display(index);
function display (index) {
	slides.forEach((slide) => {
		slide.style.display = 'none';
	});
	slides[index].style.display = 'flex';
};

function nextSlide () {
	index++;
	if (index > slides.length - 1) {
		index = 0;
	}
	display(index);
};

function prevSlide () {
	index--;
	if (index < 0) {
		index = slides.length - 1;
	}
	display(index);
};

next.addEventListener('click', nextSlide);
prev.addEventListener('click', prevSlide);