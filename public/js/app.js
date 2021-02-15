
//JQuery
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

document.addEventListener("DOMContentLoaded", function() {
    var ul = document.getElementsByTagName('ul')
    var choice = document.getElementsByClassName('choice');
    var dragItem = null;
    var statusNumberTaget = null;

    for (var i of ul) {
        i.addEventListener('dragstart', dragStart);
        i.addEventListener('dragend', dragEnd);
    }

    function dragStart() {
        dragItem = this;
        //setTimout(()=>this.style.display ='none', 0);
    }
    function dragEnd(e) {
        //setTimout(()=>this.style.display = 'block', 0);
        dragItem = null;

        let cardId = e.srcElement.dataset.cardId

        $.ajax({
            method: "PUT",
            url: "/card/" + cardId + "/status",
            data: { statusNumber: statusNumberTaget }
        })
            .done(function (msg) {
                console.log(msg)
            });

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
    function dragLeave(e) {
        //console.log(e.srcElement.getElementsByClassName('dashboardColumnContainer').srcElement[0].dataset)
        statusNumberTaget = e.srcElement.getElementsByClassName('dashboardColumnContainer')[0].dataset.statusNumber
        console.log(e.srcElement.getElementsByClassName('dashboardColumnContainer')[0].dataset.statusNumber)
        e.preventDefault();
    }
});

