<!DOCTYPE html>
<html lang="en">
<?php
function includeHead($t){
   include('../components/head.php'); 
}
includeHead('Stats');

include('../components/connection.php');
?>
<link rel="stylesheet" href="../../components/rightSideMenpu.css">


<body >
<div class="container" style="display: flex; position: relative;">
<?php include('../components/leftMenu.php'); ?>

<div class="body">
   <div class="boardContainer">
<?php
$sql = "SELECT name FROM categories";
$res = mysqli_query($con , $sql);
$categories = array();
while($r = mysqli_fetch_array($res , MYSQLI_ASSOC)){
array_push($categories , $r['name']);
}

$sql = 
"SELECT      times_added ,name ,category
FROM        items
;";
$res = mysqli_query($con,$sql);
$t = 0;
$arr = array();
$carr = array();
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
   $t = $t+$row['times_added'];
   foreach($categories as $x=>$y){
      if ($row['category'] == $y) {
         if (!array_key_exists($y,$carr)) {
            $carr[$y]= $row['times_added'];
         }
         else{
            $carr[$y]= $carr[$y]+$row['times_added']; 
         }

         

      }
   }
   array_push($arr,$row); 

}

arsort($arr);
arsort($carr);
$categoriesWT = array();
foreach($carr as $a => $b){
   $x = array('times_added'=>$b,'name'=>$a);
      array_push($categoriesWT , $x);
}

?>


   <div class="topItems">
      <h1>Top Items</h1>

      <div class="item item1">
         <div class="top">
            <p class="name"><?php echo $arr[0]['name']; ?></p>
            <p class="percentage" ><span><?php
            $s=$arr[0]['times_added'];
            $p = 100 * $s / $t;
            echo round($p);
             ?></span>%</p>

         </div>
         <div class="bottom">
            <div class="container">
               <div class="filled" data-p="<?php echo $p; ?>"></div>
            </div>
         </div>
      </div>

      <div class="item item2">
         <div class="top">
            <p class="name"><?php echo $arr[1]['name']; ?></p>
            <p class="percentage" ><span><?php
            $s=$arr[1]['times_added'];
            $p = 100 * $s / $t;
            echo round($p);
             ?></span>%</p>

         </div>
         <div class="bottom">
            <div class="container">
               <div class="filled" data-p="<?php echo $p; ?>"></div>
            </div>
         </div>
      </div>

      <div class="item item3">
         <div class="top">
            <p class="name"><?php echo $arr[2]['name']; ?></p>
            <p class="percentage" ><span><?php
            $s=$arr[2]['times_added'];
            $p = 100 * $s / $t;
            echo round($p);
             ?></span>%</p>

         </div>
         <div class="bottom">
            <div class="container">
               <div class="filled" data-p="<?php echo $p; ?>"></div>
            </div>
         </div>
      </div>

   </div>


   <div class="topCategories">
      <h1>Top Categories</h1>

      <div class="item item1">
         <div class="top">
            <p class="name"><?php echo $categoriesWT[0]['name']; ?></p>
            <p class="percentage" ><span><?php
            $s=$categoriesWT[0]['times_added'];
            $p = 100 * $s / $t;
            echo round($p);
             ?></span>%</p>

         </div>
         <div class="bottom">
            <div class="container">
               <div class="filled" data-p="<?php echo $p; ?>"></div>
            </div>
         </div>
      </div>

      <div class="item item2">
         <div class="top">
            <p class="name"><?php echo $categoriesWT[1]['name']; ?></p>
            <p class="percentage" ><span><?php
            $s=$categoriesWT[1]['times_added'];
            $p = 100 * $s / $t;
            echo round($p);
             ?></span>%</p>

         </div>
         <div class="bottom">
            <div class="container">
               <div class="filled" data-p="<?php echo $p; ?>"></div>
            </div>
         </div>
      </div>

      <div class="item item3">
         <div class="top">
            <p class="name"><?php echo $categoriesWT[2]['name']; ?></p>
            <p class="percentage" ><span><?php
            $s=$categoriesWT[2]['times_added'];
            $p = 100 * $s / $t;
            echo round($p);
             ?></span>%</p>

         </div>
         <div class="bottom">
            <div class="container">
               <div class="filled" data-p="<?php echo $p; ?>"></div>
            </div>
         </div>
      </div>

   </div>
   </div>

  
   
   <div class="graphContainer">
   <?php
   $sql = "SELECT last_edited_time FROM lists";
   $res = mysqli_query($con,$sql);
   $t= array();
   $dates = array();
   while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
      
   
      $curr = strtotime(date("Y-m"));
      $prev = strtotime(date('Y-m',strtotime($row['last_edited_time'])));
   
      if ($curr-$prev<= 2*3600*24*256) {
         array_push($t,$prev);
      }else{
      }
      
   
   
   }
   $graphData=array();
   $t = array_count_values($t);
   krsort($t);
   foreach ($t as $x => $y) {
      array_push($graphData,array('x'=>1000 * $x , 'y'=>$y));
   }

   ?>
   <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
   theme: "light2",
	title:{
		text: "Monthly Summary"
	},
	axisY: {
		valueFormatString: "##,###.",
	},
	data: [{
      lineColor:'#F9A109',
      interactivityEnabled: false,
      markerColor:'#F9A109',
      markerBorderColor:'#F9A109',
		type: "spline",
		markerSize: 5,
		xValueFormatString: "MMM YYYY",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($graphData, JSON_NUMERIC_CHECK); ?>
	}]
});

 
chart.render();
 
}
</script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<div id="chartContainer"></div>

   
   </div>
</div>

<?php include('../components/rightMenu.php'); ?>

</div>




</body>
</html>