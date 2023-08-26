let bnavBtns = document.querySelector('nav.leftSideMenu').querySelectorAll('a')
bnavBtns.forEach(b => {
   let href = b.getAttribute('href')
   b.setAttribute('href', '../' + href)
})
const navBtn = document.querySelector('a.history')
navBtn.classList.add('active')

const popup = document.querySelector('.popup')

function showPopup() {
   popup.style.display = 'flex'
}

function hidePopup() {
   popup.style.display = 'none'
}
let cancelBtn = document.querySelector('button.cancel')
cancelBtn.addEventListener('click', (e) => {
   e.preventDefault()
   showPopup();
})