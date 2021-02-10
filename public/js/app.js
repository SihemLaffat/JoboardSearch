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
