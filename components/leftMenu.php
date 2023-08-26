<style>
   .leftSideMenu {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-color: white;
      position: sticky;
      top: 0;
      height: 100vh;
      width: 100px;
   }

   .leftSideMenu .navBtns {
      display: flex;
      flex-direction: column;
      gap: 1rem;
   }

   .leftSideMenu a {
      padding: 1rem 1.5rem;
   }

   .leftSideMenu a,
   .leftSideMenu button {
      position: relative;
      font-size: 1.4rem;
      color: var(--dark);
   }

   .leftSideMenu button {
      color: white;
      background: var(--yellow);
      border-radius: 100vmax;
      display: block;
      margin: 1rem;
      padding: 1rem;
      align-self: flex-start;
   }

   .leftSideMenu .navBtns a.active::after {
      position: absolute;
      content: '';
      background: var(--yellow);
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      height: 100%;
      width: 5px;
   }

   .leftSideMenu .navBtns a::before {
      content: attr(data-name);
      position: absolute;
      top: 50%;
      left: 100%;
      background-color: var(--dark);
      color: white;
      transform: translateY(-50%);
      font-size: 1rem;
      border-radius: 5px;
      padding: 5px 10px;
      display: none;

   }

   .leftSideMenu .navBtns a:hover::before {
      display: block;
   }

   .leftSideMenu button span {
      background: var(--red);
      color: white;
      position: absolute;
      top: 0;
      right: 0;
      padding: 5px;
      font-size: 0.8rem;
   }

   @media (max-width:1024px) {
      .leftSideMenu {
         width: 70px;
      }

   }
</style>

<nav class="leftSideMenu">
   <a href="#" class="logo"><img src="../images/logo.svg" alt=""></a>
   <div class="navBtns">
      <a href="../items" class="items" data-name="items"><i class="fa-solid fa-list-ul"></i></a>
      <a href="../history" class="history" data-name="history"><i class="fa-solid fa-rotate-left"></i></a>
      <a href="../stats" class="stats" data-name="stats"><i class="fa-solid fa-chart-column"></i></a>
   </div>
   <button class="listToggle" onclick="backToMain();toggleRight();"><i class="fa-solid fa-cart-shopping"></i><span>0</span></button>
</nav>

<script>
   const navBtns = document.querySelector('.navBtns').querySelectorAll('a')
   navBtns.forEach(e => {
      e.addEventListener('click', () => {
         setTimeout(() => {
            e.classList.toggle('active')

         }, 200);
      })
   });
</script>