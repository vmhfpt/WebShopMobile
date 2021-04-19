<?php
require_once ('./Help.php');
  
  if(!empty($_POST)){
    if(isset($_POST['id_product'])){
      $id_product = $_POST['id_product'];
    }
      if(isset($_POST['id'])){
          $id = $_POST['id'];
       $sql = "SELECT * FROM `nokia` WHERE `category` = $id";
        $result = executeResult($sql);
        $NameCategory = "SELECT * FROM `menu` WHERE `id` = $id";
        $ResultName = executeSingleResult($NameCategory);
        echo '<a href="ResultProduct.php?id='.$id_product.'"><button type="button" class="btn btn-outline-warning">⤫ '.$ResultName['name'].'</button></a><br/><br/>';
        foreach($result as $key => $value){
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
  }
?>