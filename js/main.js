

const btn = document.getElementsByClassName('toggle-button')[0];
const navLinks = document.getElementsByClassName('nav-links')[0];

btn.addEventListener('click', () => {
    navLinks.classList.toggle('active');
})



let tabel = document.getElementById('table');
const btnShow = document.getElementById('filier');

btnShow.addEventListener('click',()=>{
    tabel.classList.toggle('show-table');
})