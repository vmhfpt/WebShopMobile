<?php
 require_once ('./Help.php');
 /// limited width number 12 for show product 
 $limit = 12;
 $offset = 0;
 $SortPrice = false;
 $sort = 0;
 $type = 0;
 $sql = 'SELECT * FROM `products_bought`';
if(!empty($_POST)){
    if(isset($_POST['page'])){
        $page = $_POST['page'];
        $limit = $limit * $page;
    }
    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }
    if(isset($_POST['sort'])){
         if ($_POST['sort'] == 1){
            $sort = 1;
             $SortPrice = true;
         }
         if ($_POST['sort'] == 2){
           $sort = 2;
            $SortPrice = true;
        }
    }
    if(isset($_POST['type'])){
        if($_POST['type'] == 2){
            $type = $_POST['type'] ;
          // echo 'Sản phẩm bán chạy'; die();
           $sql = 'SELECT * FROM `products_bought`';
        } else if($_POST['type'] == 3){
            $type = $_POST['type'] ;
         //   echo 'Sản phẩm mua nhiều nhất';die();
            $sql = 'SELECT * FROM `selling_products`';
        }
    }
    //echo $page. "---------". $price ;die();
}




?>
  <?php
    
  
    $result = executeResult($sql);
   $char = '';
   foreach($result as $key => $value){
          $char = $char. $value['id_product']. ",";
   } 
   $char = substr($char, 0, -1);
   if($char == ''){
    $char = 0;
  }
  $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')';
 
  if($SortPrice == false){
   if($price != 0){
      if ($price == '2tr'){
         // echo '<=2tr';
         $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` <= 2000000 ';
      }
      if ($price == '2tr-4tr'){
      //  echo '2tr-4tr';
      $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` BETWEEN 2000000 AND 4000000';
    }
    if ($price == '4tr-7tr'){
       // echo '4tr-7tr';
       $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` BETWEEN 4000000 AND 7000000';
    }
    if ($price == '7tr-13tr'){
       // echo '4tr-7tr';
       $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` BETWEEN 7000000 AND 13000000';
    }
    if ($price == '13tr-20tr'){
        $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` BETWEEN 13000000 AND 20000000';
      //  echo '13tr-20tr';
    }
    if ($price == '20tr'){
      //  echo '4tr-7tr';
      $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` >= 20000000 ';
    }
  //die();


   }
  }
  if ($SortPrice == true && $_POST['sort'] == 1){
  //  echo 'Sắp xếp từ cao đén thấp';
    if($price != 0){
      //   echo "<br/>Có tồn tại giá";
       switch ($price){
            case '2tr':
               // echo 'Giam dan vs gia  duoi 2 tr';
               // SELECT * FROM `nokia` WHERE `id` IN (314,315,316,317,318,319,320,321,322,324,329,330,331,332,333,334,335,336) AND `giamoi` >= 2000000 ORDER BY `giamoi` DESC
               $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` <= 2000000 ORDER BY `giamoi` DESC';
               //var_dump($sql); die();
                break;
                case '2tr-4tr':
                    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` BETWEEN 2000000 AND 4000000 ORDER BY `giamoi` DESC';
                   // var_dump($sql); die();
                    break;
                    case '4tr-7tr':
                        $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')  AND `giamoi` BETWEEN 4000000 AND 7000000 ORDER BY `giamoi` DESC';
                       // var_dump($sql); die();
                        break;
                        case '7tr-13tr':
                            $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')  AND `giamoi` BETWEEN 7000000 AND 13000000 ORDER BY `giamoi` DESC';
                           // var_dump($sql); die();
                            break;
                            case '13tr-20tr':
                                $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')   AND `giamoi` BETWEEN 13000000 AND 20000000 ORDER BY `giamoi` DESC';
                               // var_dump($sql); die();
                                break;
                                case '20tr':
                                    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` >= 20000000 ORDER BY `giamoi` DESC';
                                  //  var_dump($sql); die();
                                    break;
       } 

    } else {
       // echo "<br/>Không tồn tại giá";
       $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') ORDER BY `nokia`.`giamoi` DESC';
    }
    
  } else if($SortPrice == true && $_POST['sort'] == 2){
   // echo 'Sắp xếp từ thấp đến cao';
    if($price != 0){
     //   echo "<br/>Có tồn tại giá";
     switch ($price){
        case '2tr':
           // echo 'Giam dan vs gia  duoi 2 tr';
           // SELECT * FROM `nokia` WHERE `id` IN (314,315,316,317,318,319,320,321,322,324,329,330,331,332,333,334,335,336) AND `giamoi` >= 2000000 ORDER BY `giamoi` DESC
           $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` <= 2000000 ORDER BY `giamoi` ASC';
           //var_dump($sql); die();
            break;
            case '2tr-4tr':
                $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` BETWEEN 2000000 AND 4000000 ORDER BY `giamoi` ASC';
               // var_dump($sql); die();
                break;
                case '4tr-7tr':
                    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')  AND `giamoi` BETWEEN 4000000 AND 7000000 ORDER BY `giamoi` ASC';
                   // var_dump($sql); die();
                    break;
                    case '7tr-13tr':
                        $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')  AND `giamoi` BETWEEN 7000000 AND 13000000 ORDER BY `giamoi` ASC';
                       // var_dump($sql); die();
                        break;
                        case '13tr-20tr':
                            $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')   AND `giamoi` BETWEEN 13000000 AND 20000000 ORDER BY `giamoi` ASC';
                           // var_dump($sql); die();
                            break;
                            case '20tr':
                                $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') AND `giamoi` >= 20000000 ORDER BY `giamoi` ASC';
                              //  var_dump($sql); die();
                                break;
   } 

   } else {
      //SELECT * FROM `nokia` WHERE `id` IN (314,315,316,317,318,319,320,321,322,324,329,330,331,332,333,334,335,336) ORDER BY `nokia`.`giamoi` ASC
      $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') ORDER BY `nokia`.`giamoi` ASC';
     // var_dump($sql); 
   }
    
  //  die();
  }
     //SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 3000000 AND 9000000
    //SELECT * FROM `nokia` WHERE `giamoi` < 5000000
    /* if(!empty($_GET)){
      if(isset($_GET['price'])){
           if ($_GET['price'] == '2tr'){
              $sql = 'SELECT * FROM `nokia` WHERE `giamoi` < 2000000';
           }
           if ($_GET['price'] == '2tr-4tr'){
              $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 2000000 AND 4000000';
          }
          if ($_GET['price'] == '4tr-7tr'){
            $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 4000000 AND 7000000';
          }
          if ($_GET['price'] == '7tr-13tr'){
            $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 7000000 AND 13000000';
          }
          if ($_GET['price'] == '13tr-20tr'){
            $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 13000000 AND 20000000';
          }
          if ($_GET['price'] == '20tr'){
            $sql = 'SELECT * FROM `nokia` WHERE `giamoi` > 20000000';
          }
      }
    }
    
      */
      $SumCar = executeResult($sql);
      $SumAriable = count($SumCar);
      $sql = $sql . ' LIMIT '.$limit.' OFFSET '.$offset.'';
      //var_dump($sql); die();
    $result = executeResult($sql);
    //echo count($result); die();
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
     ?>
     <div style="clear : both"></div>
     <?php
     $SumCount = count($result);
     if(($SumAriable - $SumCount) > 0){
     // you need learing more tool Javascript in Ground web API
     // What is API js
     // are API js it can help for you ?
     // And do it can make in design and detail a website 

     ?>
    <center> <a href="javascript:More(<?=($page + 1)?>,'<?=$price?>', <?=$sort?>, <?=$type?>);"> <button style="color : blue !important ;
  margin : 40px ;
  border : 1px solid #000000" type="button" class="btn btn-outline-light text-dark">Xem Thêm <?=($SumAriable - $SumCount)?> Sản Phẩm</button> </a></center>
  <?php
  }
  
  ?>