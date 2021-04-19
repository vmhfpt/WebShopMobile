<?php
  require_once ('./Help.php');
// Array with names
 $sql = 'SELECT * FROM nokia ';
 $result = executeResult($sql);
 
$q = $_REQUEST["q"];

$hint = false;

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  $i = 0;
  $count = 0;
  foreach($result as $key => $value) {
    if (stristr($q, substr($value['name'], 0, $len)) == true) {
     
      $hint = true;
      if($i <= 6){
            //   echo '<a href="../Post/product.php?id='.$value['id'].'"> '.$value['name'].' </a>
            //   <img src="'.$value['image'].'" width="50" height="60"> <br/>';
            echo '<a href="../Post/product.php?id='.$value['id'].'"> <div class="product-result-seacher">
            <img style="margin : 11px 11px 0px 17px;float:left" src="'.$value['image'].'" width="50" height="60">
            <div style="margin-top: 11px;float:left">
               <h5 style="color:black"> '.$value['name'].'</h5>
               <h6 style="color:red;text-align : left">'.number_format($value['giamoi'], 0, ",", ".").'đ</h6>
            </div>
            
            
            
            
            </div></a>';
           
      }
      $i ++;
    }
   
  }
}

// Output "no suggestion" if no hint was found or output correct values
//echo $hint === "" ? "no suggestion" : $hint;

?>