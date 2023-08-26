<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shoppingify - <?php echo $t; ?></title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="shortcut icon" href="../images/logo.svg" type="image/x-icon">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <style>
      :root{


         --titles: #34333A;
         --yellow: #F9A109;
         --right-menu-bg: #FFF0DE;
         --bg: #FAFAFE;
         --add-item-bg: #80485B;
         --red: #EB5757;
         --green: #5cb85c;
         --grey: #828282;
         --dark:#454545;
         --light: #bdbdbd;
         --blue: #56CCF2;

         --shadow: 0px 2px 12px 0px #0000000A;
      }
      *{
         font-family: 'Quicksand', sans-serif;
         padding: 0;
         margin: 0;
         box-sizing: border-box;
      }
      a,button{
         all: unset;
         cursor: pointer;
      }
      .successMsg{
         color: white !important;
         font-size: 1.4rem;
         padding: 0.5rem 1rem;
         background: var(--green);
         border: 1px solid green;
         margin-top: 2rem;
      }

      .errorMsg{
         color: white !important;
         font-size: 1.4rem;
         padding: 0.5rem 1rem;
         background: var(--red);
         border: 1px solid red;
         margin-top: 2rem;
      }



   </style>
   <link rel="stylesheet" href="./style.css">
   <script src="script.js" defer></script>

   
</head>