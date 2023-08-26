let ranges = document.querySelectorAll('.filled')
ranges.forEach(x => {
   let p = x.dataset.p
   x.style.width = p + '%'
})


const navBtn = document.querySelector('a.stats')
navBtn.classList.add('active')