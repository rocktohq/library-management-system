const inputs = document.querySelectorAll(".input");


function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

var info = document.querySelector('.info');
const dev = document.getElementById('devinfo');
dev.addEventListener("click", function() {
    info.classList.add('active');
});

const close = document.querySelector('.close');
close.addEventListener("click", function() {
    info.classList.remove('active');
});