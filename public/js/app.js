//JQuery
$(document).ready(function() {
    

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