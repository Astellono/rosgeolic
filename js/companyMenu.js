let poly = document.getElementById('poly')
let info = document.getElementById('info')

let boxInfo = document.querySelector('.info__list')
let boxCoor = document.querySelector('.container__coord')
console.log(boxCoor);
console.log(boxInfo);
poly.addEventListener('click', ()=> {
    boxCoor.style.display = 'block'
    boxInfo.style.display = 'none'
    poly.classList.add('active__menu')
    info.classList.remove('active__menu')
})

info.addEventListener('click', ()=> {
    boxCoor.style.display = 'none'
    boxInfo.style.display = 'block'
    info.classList.add('active__menu')
    poly.classList.remove('active__menu')
})



