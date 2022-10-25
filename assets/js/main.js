// Loader
var loader = document.getElementById("pre-loader");
loader.classList.add("remove");
// setTimeout(() => { loader.classList.add("remove"); }, 500);

// Initialize AOS
// AOS.init();

// Up Button on Scroll
const element = document.querySelector('.up-button');

function onScroll(event) {
    const current = document.documentElement.scrollTop;
    const maxHeight = document.body.scrollHeight;

    // If Current Position is more than 80% of the Document Height
    if (current > maxHeight * 0.2) {
        element.classList.add('is-active');
    } else {
        element.classList.remove('is-active');
    }
}

window.addEventListener('scroll', event => onScroll(event));

// Go to Top
function toTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}