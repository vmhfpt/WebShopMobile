<?php
       require_once ('./Help.php');
     if (isset($_POST['price'])){
         $price = $_POST['price'];
     }
     if (isset($_POST['id_category'])){
         $id_category = $_POST['id_category'];
     }
     if (isset($_POST['id_category_sort'])){
        $id_category_sort = $_POST['id_category_sort'];
    }
    if($id_category_sort != 'null'){
    $NameCategory = "SELECT * FROM `menu` WHERE `id` = $id_category_sort";
        $ResultName = executeSingleResult($NameCategory);
        echo '<a  href="ResultProduct.php?id='.$id_category.'"><button type="button" class="btn btn-outline-warning">⤫ '.$ResultName['name'].'</button></a><br/><br/>';
    }
    if ($price == '2tr'){
        echo '<a href="ResultProduct.php?id='.$id_category.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Dưới 2 triệu</button></a> <br/> <br/>';
    }
    if ($price == '2tr-4tr'){
      echo '<a href="ResultProduct.php?id='.$id_category.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 2 - 4 triệu</button></a> <br/> <br/>';
  }
  if ($price == '4tr-7tr'){
    echo '<a href="ResultProduct.php?id='.$id_category.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 4 - 7 triệu</button></a> <br/> <br/>';
}
if ($price == '7tr-13tr'){
  echo '<a href="ResultProduct.php?id='.$id_category.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 7 - 13 triệu</button></a> <br/> <br/>';
}
if ($price == '13tr-20tr'){
echo '<a href="ResultProduct.php?id='.$id_category.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 13 - 20 triệu</button></a> <br/> <br/>';
}
if ($price == '20tr'){
echo '<a href="ResultProduct.php?id='.$id_category.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Trên 20 triệu</button></a> <br/> <br/>';
}
   // echo '<a href="resultProduct.php?id="> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Trên 20 triệu</button></a> <br/> <br/>';
 // echo  $price. "<br/>";
 //echo   $id_category . "<br/>";
//echo   $id_category_sort. "<br/>"; die();
if ($id_category_sort == 'null'){
    $sqlName = 'SELECT * FROM menu WHERE id ='.$id_category;
    $resultName = executeSingleResult($sqlName);
  //  echo $resultName['name'];
  if ($price == '2tr'){
   $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$resultName['name']."%' AND `giamoi` <= 2000000 ";
   //var_dump($sql);
  }
  if ($price == '2tr-4tr'){
    $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$resultName['name']."%' AND `giamoi` BETWEEN 2000000 AND 4000000";
    //var_dump($sql);
   }
   if ($price == '4tr-7tr'){
    $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$resultName['name']."%' AND `giamoi` BETWEEN 4000000 AND 7000000";
    //var_dump($sql);
   }
   if ($price == '7tr-13tr'){
    $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$resultName['name']."%' AND `giamoi` BETWEEN 7000000 AND 13000000";
   // var_dump($sql);
   }
   if ($price == '13tr-20tr'){
    $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$resultName['name']."%' AND `giamoi` BETWEEN 13000000 AND 20000000";
   // var_dump($sql);
   }
   if ($price == '20tr'){
    $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$resultName['name']."%' AND `giamoi` >= 20000000 ";
    //var_dump($sql);
   }
   //SELECT * FROM `nokia` WHERE `giamoi` > 1000000 AND `category` = 39 ORDER BY `giamoi` ASC
} else {
    //SELECT * FROM `nokia` WHERE `giamoi` >= 2000000 AND `category` = 39 ORDER BY `giamoi` ASC
    if ($price == '2tr'){
        $sql = "SELECT * FROM `nokia` WHERE `giamoi` <= 2000000 AND `category` = $id_category_sort";
      //  var_dump($sql);die();
       }
       if ($price == '2tr-4tr'){
         $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 2000000 AND 4000000 AND `category` = $id_category_sort";
        // var_dump($sql);
        }
        if ($price == '4tr-7tr'){
            $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 4000000 AND 7000000 AND `category` = $id_category_sort";
        // var_dump($sql);
        }
        if ($price == '7tr-13tr'){
            $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 7000000 AND 13000000 AND `category` = $id_category_sort";
        // var_dump($sql);
        }
        if ($price == '13tr-20tr'){
            $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 13000000 AND 20000000 AND `category` = $id_category_sort";
        // var_dump($sql);
        }
        if ($price == '20tr'){
            $sql = "SELECT * FROM `nokia` WHERE `giamoi` >= 20000000 AND `category` = $id_category_sort";
         //var_dump($sql);
        }
}
   $result = executeResult($sql);
   foreach ($result as $key => $value){
?>
<div class="Select-introduce">
         <center> <img src="<?=$value['image']?>" width="170" height="170"></center>
         <h4> <?=$value['name']?> </h4>
         <h6> <?=number_format($value['giacu'], 0, ",", ".")?>đ</h6>
         <h5> <?=number_format($value['giamoi'], 0, ",", ".")?>đ</h5>
         <center> <a href="product.php?id=<?=$value['id']?>"><button style="float:none !important" type="button" class="btn btn-success">Xem chi tiết</button></a></center>
         <center> <button onclick="AddCart(<?=$value['id']?>)" style="margin-top : 12px" type="button" class="btn btn-warning">Thêm Vào Giỏ Hàng</button></center>
         <?php    
           $sqlVote = 'SELECT * FROM `voteproduct` WHERE `id_product` = '.$value['id'].' ';
           $resultVote = executeSingleResult($sqlVote);
           
           $countVote = 0;$test = 0;
           $TBCStar = 0;$Star = 1;
              foreach($resultVote as $key){
                  if( $test < 2){
                      $test ++;
                      continue ;
                  }
                  //echo  $key. "   ";
                  $TBCStar =  $TBCStar + ($Star * $key); 
                  $Star ++;
                  $countVote = $countVote +  $key;
              }
             
         
         ?>
     <?php
      if($countVote != 0){
        $temoarray = $TBCStar/$countVote;
       ?>

<a href="product.php?id=<?=$value['id']?>">  <div class="roundStar">
        <?php
      
        $j = 1;
            //echo $value['vote'];
            
            for(; $j <= $temoarray; $j ++){
      ?>
       
    <img src="https://i.pinimg.com/originals/79/0c/e5/790ce50a0d73665b9b657fc0dbb9c552.png" width="14" height="14">
    
  
  <?php } if ($j <= 5){
     for (;$j <= 5; $j ++){
       echo '<img src="https://image.flaticon.com/icons/png/512/69/69495.png" width="14" height="14">';
     }
  }
   
        ?>
         <span class="spanVote">  <?=  $countVote ?> đánh giá</span>
       </div></a>




       <?php
       } 
     ?>
     </div>

<?php }

/** if ($_GET['price'] == '2tr'){
            echo '<a href="resultProduct.php?id='.$id.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Dưới 2 triệu</button></a> <br/> <br/>';
        }
        if ($_GET['price'] == '2tr-4tr'){
          echo '<a href="resultProduct.php?id='.$id.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 2 - 4 triệu</button></a> <br/> <br/>';
      }
      if ($_GET['price'] == '4tr-7tr'){
        echo '<a href="resultProduct.php?id='.$id.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 4 - 7 triệu</button></a> <br/> <br/>';
    }
    if ($_GET['price'] == '7tr-13tr'){
      echo '<a href="resultProduct.php?id='.$id.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 7 - 13 triệu</button></a> <br/> <br/>';
  }
  if ($_GET['price'] == '13tr-20tr'){
    echo '<a href="resultProduct.php?id='.$id.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Từ 13 - 20 triệu</button></a> <br/> <br/>';
}
if ($_GET['price'] == '20tr'){
  echo '<a href="resultProduct.php?id='.$id.'"> <button style="margin : 0px 0px 0px 14px" type="button" class="btn btn-danger">⤫ Trên 20 triệu</button></a> <br/> <br/>';
} */


?>
