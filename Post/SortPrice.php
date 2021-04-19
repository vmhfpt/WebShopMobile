<?php
 require_once ('./Help.php');
  if (!empty($_POST['sort'])){
    if (isset($_POST['price']) && $_POST['price'] != 0){
      $price = $_POST['price'];
     if ($price == '2tr' ){
        if ($_POST['sort'] == 1){
             $sql = "SELECT * FROM `nokia` WHERE `giamoi` < 2000000 ORDER BY `nokia`.`giamoi` DESC";
        } else {
          $sql = "SELECT * FROM `nokia` WHERE `giamoi` < 2000000 ORDER BY `nokia`.`giamoi` ASC";
        }
     }
     if ($price == '2tr-4tr'){
     if($_POST['sort'] == 1){
      $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 2000000 AND 4000000 ORDER BY `nokia`.`giamoi` DESC";
     } else {
      $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 2000000 AND 4000000 ORDER BY `nokia`.`giamoi` ASC";
     }
}
if ($price == '4tr-7tr'){
  if($_POST['sort'] == 1){
  $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 4000000 AND 7000000 ORDER BY `nokia`.`giamoi` DESC";
  } else {
    $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 4000000 AND 7000000 ORDER BY `nokia`.`giamoi` ASC";
  }
}
if ($price == '7tr-13tr'){
  if($_POST['sort'] == 1){
  $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 7000000 AND 13000000 ORDER BY `nokia`.`giamoi` DESC";
  } else {
    $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 7000000 AND 13000000 ORDER BY `nokia`.`giamoi` ASC";
  }
}
if ($price == '13tr-20tr'){
  if($_POST['sort'] == 1){
  $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 13000000 AND 20000000 ORDER BY `nokia`.`giamoi` DESC";
  } else {
    $sql = "SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 13000000 AND 20000000 ORDER BY `nokia`.`giamoi` ASC";
  }
}
if ($price == '20tr' ){
  if( $_POST['sort'] == 1){
  $sql = "SELECT * FROM `nokia` WHERE `giamoi` > 20000000 ORDER BY `nokia`.`giamoi` DESC";
  } else {
    $sql = "SELECT * FROM `nokia` WHERE `giamoi` > 20000000 ORDER BY `nokia`.`giamoi` ASC";
  }
}
    } else {

    if ($_POST['sort'] == 1){
      $sql = 'SELECT * FROM `nokia` ORDER BY `nokia`.`giamoi` DESC';
    }
    if ($_POST['sort'] == 2){
        $sql = 'SELECT * FROM `nokia` ORDER BY `nokia`.`giamoi` ASC';
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
<?php
    }
  }




?>