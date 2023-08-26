<link rel="stylesheet" href="../components/rightSideMenu.css">
<style>

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script>
   function deleteItem(item) {
      let shoppingList = document.querySelectorAll('.shoppingList')
      let parent = item.parentElement
      item.outerHTML = ''
      if (parent.childElementCount == 1) {
         parent.outerHTML = ''
      }
      shoppingList.forEach(el => {
         if (el.childElementCount == 1) {
            el.querySelector('img').style.display = 'block'

         }
      })
      updateBtmCart()


   }
</script>

<nav class="rightSideMenu main">

   <div class="addItem">
      <img src="../images/ketchup-bottle.svg" alt="">
      <div class="text">
         <p>didn't find what you need?</p>
         <button onclick="addItemPage()">Add item</button>

      </div>

   </div>
   <div class="shoppingListTxt">
      <p>Shopping list</p>
      <button onclick="toggleState()"><i class="fa-solid fa-pen"></i></button>
   </div>
   <form action="../components/saveList.php" method="post">
      <div class="shoppingList edit active">


         <img src="../images/empty-cart.svg" alt="">
         <script>
            let shoppingList = document.querySelector('.shoppingList.edit')

            function updateBtmCart() {
               let c = 0
               let inputs = [...shoppingList.querySelectorAll('input')]
               let cartNum = document.querySelector('.listToggle').querySelector('span')
               if (inputs != []) {
                  inputs.forEach(i => {
                     c = c + Number(i.getAttribute('value'))
                  })

               } else {
                  c = 0
               }
               cartNum.innerText = c

            }
            updateBtmCart()
         </script>

      </div>


      <div class="shoppingList complete ">

         <img src="../images/empty-cart.svg" alt="">


      </div>
      <div class="actions">
         <div class="editBtns active">
            <input type="text" name="listName" id="listName" placeholder="Enter name" required>
            <button type="submit" name="submit">Save</button>
         </div>

         <div class="completeBtns">
            <button onclick="toggleState()">cancel</button>
            <button class="completeBtn">complete</button>
         </div>


      </div>

   </form>
</nav>

<nav class="rightSideMenu addItemContainer">
   <form action="../components/addItem.php" method="post">
      <h1>Add a new item</h1>

      <label for="name">name:</label>
      <input type="text" name="name" id="nameInp" placeholder="Enter A Name" required autocomplete="off">


      <label for="note">note (optional):</label>
      <textarea name="note" id="noteInp" cols="10" rows="5" placeholder="Enter A Note" autocomplete="off"></textarea>

      <label for="image">image (optional):</label>
      <input type="text" name="image" id="imageInp" placeholder="Enter A URL" autocomplete="off">


      <label for="category">category:</label>
      <input type="text" name="category" id="categoryInp" placeholder="Enter A category" required autocomplete="off">
      <div style="position: relative;">
         <ul>

            <?php

            $sql = "SELECT name FROM categories";
            $res = mysqli_query($con, $sql);


            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
               echo '<li>' . $row['name'] . '</li>';
            }
            ?>

         </ul>
      </div>

      <div class="buttons">
         <button type="cancel" onclick="backToMain()" class="cancelBtn">cancel</button>
         <button type="submit" name="submit" class="submitBtn">Save</button>
      </div>


   </form>

</nav>

<script>
   const categoryInp = document.querySelector('#categoryInp')
   const availableCategories = [...categoryInp.nextElementSibling.querySelectorAll('li')]
   availableCategories.forEach(el => {
      el.onclick = () => {
         categoryInp.value = el.innerText
      }
   })
   categoryInp.addEventListener('input', () => {
      let c = 0
      availableCategories.forEach(el => {
         let v = el.innerText;
         let i = categoryInp.value;

         if (v.includes(i)) {
            el.style.display = 'block'

         } else {
            el.style.display = 'none'
         }

         if (el.style.display != 'none') {
            c++
         }

      })
      if (c == 0) {
         categoryInp.nextElementSibling.style.display = 'none'

      } else {
         categoryInp.nextElementSibling.style.display = 'block'
      }
   })
</script>


<style>

</style>


<nav class="rightSideMenu showItemContainer">
   <button class="backBtn" onclick="backToMain()"><i class="fa-solid fa-arrow-left"></i> back</button>

   <img src="https://cdn.britannica.com/72/170772-050-D52BF8C2/Avocado-fruits.jpg" alt="">

   <div class="info name">
      <p>name</p>
      <h3>avocado</h3>
   </div>

   <div class="info category">
      <p>category</p>
      <h3>avocado</h3>
   </div>

   <div class="info note">
      <p>note</p>
      <h3>avocado</h3>
   </div>

   <script>
      function quantityInc() {
         document.querySelector('.info.quantity .display').innerText++
      }

      function quantityDec() {
         if (document.querySelector('.info.quantity .display').innerText != 1) {
            document.querySelector('.info.quantity .display').innerText--

         }
      }
   </script>

   <div class="info quantity">
      <button onclick="quantityInc()"><i class="fa-solid fa-plus"></i></button>
      <span class="display">1</span>
      <button onclick="quantityDec()"><i class="fa-solid fa-minus"></i></button>
   </div>

   <div class="buttons">
      <button type="cancel" onclick="backToMain()" class="cancelBtn">cancel</button>
      <button type="submit" name="submit" class="addToListBtn">Add to list</button>
   </div>

</nav>

<script>
   let addToListBtn = document.querySelector('.addToListBtn')
   addToListBtn.addEventListener('click', () => {
      let item = document.querySelector('.info.name h3').innerText
      let category = document.querySelector('.info.category h3').innerText
      let quantity = document.querySelector('.info.quantity span').innerText

      addItem(item, category, Number(quantity))
      backToMain();
   })

   function toggleRight() {
      let right = document.querySelectorAll('.rightSideMenu')
      setTimeout(() => {

         right.forEach(r => {
            r.classList.toggle('active');
         })
      }, 100);

   }

   const left = document.querySelector('.leftSideMenu')
   const right = document.querySelectorAll('.rightSideMenu')
   const body = document.querySelector('.body')
   if (window.innerWidth <= 768) {
      document.addEventListener('click', (e) => {
         [left, body].forEach(el => {
            if (el.contains(e.target)) {
               right.forEach(n => {
                  if (n.className.includes('active')) {
                     n.classList.remove('active')
                  }

               })
            }
         })
      })
   }




   function toggleState() {
      document.querySelector('.shoppingList.edit').classList.toggle('active')
      document.querySelector('.editBtns').classList.toggle('active')
      document.querySelector('.completeBtns').classList.toggle('active')

      document.querySelector('.shoppingList.complete').classList.toggle('active')
   }

   function addItemPage() {
      document.querySelector('.rightSideMenu.main').style.display = 'none'
      document.querySelector('.rightSideMenu.addItemContainer').style.display = 'block'
      document.querySelector('.rightSideMenu.showItemContainer').style.display = 'none'


   }

   function backToMain() {
      document.querySelector('.rightSideMenu.main').style.display = 'block'
      document.querySelector('.rightSideMenu.addItemContainer').style.display = 'none'
      document.querySelector('.rightSideMenu.showItemContainer').style.display = 'none'

   }



   function showItem(item, category) {
      document.querySelector('.rightSideMenu.main').style.display = 'none'
      document.querySelector('.rightSideMenu.showItemContainer').style.display = 'block'
      document.querySelector('.rightSideMenu.addItemContainer').style.display = 'none'
      document.querySelector('.info.quantity span').innerText = 1

      toggleRight()
      $.ajax({
         type: 'post',
         url: '../components/showItem.php',
         data: {
            item: item,
            category: category,
         },
         success: function(response) {
            $('#res').html(response);
            obj = JSON.parse(response);


            function checkImage(link) {
               var request = new XMLHttpRequest();
               request.open("GET", link, true);
               request.send();
               request.onload = function() {
                  status = request.status;
                  if (request.status == 200) //if(statusText == OK)
                  {
                     return true
                  } else {
                     return false
                  }
               }
            }


            let img = document.querySelector('.rightSideMenu.showItemContainer img')
            if (checkImage(obj.image)) {
               img.style.display = 'block'

               img.setAttribute('src', obj.image)
            } else {
               img.style.display = 'none'

            }
            let item = document.querySelector('.info.name h3')
            let category = document.querySelector('.info.category h3')
            let note = document.querySelector('.info.note h3')

            item.innerText = obj.item
            category.innerText = obj.category
            if (obj.note != '') {
               note.innerText = obj.note
               note.parentElement.style.display = 'block'

            } else {
               note.parentElement.style.display = 'none'
            }

         }
      });

   }
</script>