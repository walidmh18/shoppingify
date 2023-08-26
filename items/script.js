const navBtn = document.querySelector('a.items')
navBtn.classList.add('active')
const rightShoppingListEdit = document.querySelector('.rightSideMenu').querySelector('.shoppingList.edit')
const rightShoppingListComplete = document.querySelector('.rightSideMenu').querySelector('.shoppingList.complete')



function addItem(item, category, quantity) {
   let n = 0
   let m = 0
   let u = 0
   rightShoppingListEdit.querySelectorAll('.category').forEach(el => {
      let name = el.querySelector('p.categoryName').innerText
      if (name == category) {
         n++
      }
   });
   if (n == 0) {
      let newCategory = document.createElement('div')
      newCategory.classList.add('category')

      let categoryName = document.createElement('p')
      categoryName.classList.add('categoryName')
      categoryName.innerText = category
      newCategory.append(categoryName)


      let newItem = document.createElement('div')
      newItem.classList.add('item')
      newItem.innerHTML = `<input type="hidden" name="item[${item}]" value="${quantity}">
               <p class="name">${item} <button onclick="deleteItem(this.parentElement.parentElement)"><i class="fa-solid fa-trash"></i></button></p>
               <p class="quantity">${quantity}pcs</p>`
      newCategory.append(newItem)
      rightShoppingListEdit.append(newCategory)




      let newCategory2 = document.createElement('div')
      newCategory2.classList.add('category')

      let categoryName2 = document.createElement('p')
      categoryName2.classList.add('categoryName')
      categoryName2.innerText = category
      newCategory2.append(categoryName2)


      let newItem2 = document.createElement('div')
      newItem2.classList.add('item')
      newItem2.innerHTML = `
               <div style="display: flex;align-items:center;">
                     <input id="${item}checkbox" class="check" type="checkbox">
                     <div class="checkbox-wrapper">
                        <label class="label" for="${item}checkbox">
                           <svg viewBox="0 0 95 95" height="45" width="45">
                              <rect fill="none" stroke="#F9A109" stroke-width="5" height="50" width="50" y="20" x="30"></rect>
                              <g transform="translate(0,-952.36222)">
                              <path class="path1" fill="none" stroke-width="3" stroke="black" d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4"></path>
                              </g>
                           </svg>
                           
                        </label>
                     </div>


                     <label for="${item}" class="name">${item}</label>
                  </div>
                  <p class="quantity">${quantity} pcs</p>
               
               `
      newCategory2.append(newItem2)
      rightShoppingListComplete.append(newCategory2)



      let shoppingList = document.querySelectorAll('.shoppingList')
      shoppingList.forEach(el => {
         if (el.childElementCount > 1) {
            el.querySelector('img').style.display = 'none'

         }
      })
   } else if (n == 1) {
      rightShoppingListEdit.querySelectorAll('.category').forEach(el => {
         let categoryName = el.querySelector('p.categoryName').innerText
         if (categoryName == category) {

            el.querySelectorAll('.item').forEach(i => {
               let itemName = i.querySelector('input').getAttribute('name')
               if (itemName == `item[${item}]`) {
                  m++
               }
            })

            if (m == 0) {
               let newItem = document.createElement('div')
               newItem.classList.add('item')
               newItem.innerHTML = `<input type="hidden" name="item[${item}]" value="${quantity}">
                     <p class="name">${item} <button onclick="deleteItem(this.parentElement.parentElement)"><i class="fa-solid fa-trash"></i></button></p>
                     <p class="quantity">${quantity}pcs</p>`
               el.append(newItem)

               rightShoppingListComplete.querySelectorAll('.category').forEach(el2 => {
                  let categoryName2 = el2.querySelector('p.categoryName').innerText
                  if (categoryName2 == category) {


                     let newItem2 = document.createElement('div')
                     newItem2.classList.add('item')
                     newItem2.innerHTML = `<div style="display: flex;align-items:center;">
                              <input id="${item}checkbox" class="check" type="checkbox">
                              <div class="checkbox-wrapper">
                                 <label class="label" for="${item}checkbox">
                                    <svg viewBox="0 0 95 95" height="45" width="45">
                                       <rect fill="none" stroke="#F9A109" stroke-width="5" height="50" width="50" y="20" x="30"></rect>
                                       <g transform="translate(0,-952.36222)">
                                       <path class="path1" fill="none" stroke-width="3" stroke="black" d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4"></path>
                                       </g>
                                    </svg>
                                    
                                 </label>
                              </div>


                              <label for="${item}" class="name">${item}</label>
                           </div>
                           <p class="quantity">${quantity} pcs</p>
                        `
                     el2.append(newItem2)

                  }
               })
            } else {
               el.querySelectorAll('.item').forEach(i => {
                  let itemName = i.querySelector('input').getAttribute('name')
                  if (itemName == `item[${item}]`) {
                     i.querySelector('input').setAttribute('value', Math.ceil(+i.querySelector('input').getAttribute('value') + quantity))
                     i.querySelector('.quantity').innerText = i.querySelector('input').getAttribute('value') + ' pcs'
                     rightShoppingListComplete.querySelectorAll('.category').forEach(el2 => {
                        el2.querySelectorAll('.item').forEach(t => {
                           let itemName2 = `item[${t.querySelector('label.name').getAttribute('for')}]`
                           if (itemName2 == itemName) {
                              t.querySelector('.quantity').innerText = i.querySelector('input').getAttribute('value') + ' pcs'

                           }
                        })
                     })
                  }
               })

            }

         }

      });


   }
   updateBtmCart();
}