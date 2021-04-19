<?php
require_once ('./Help.php');
 $limit = 12;
 $offset = 0;
 $SortType = 0;
 $RoundPrice = 0;
 $nameButton = '';
 $nameButtonSort = '';
 $SortType = 0;
 if(!empty($_POST)){
     if(isset($_POST['SortType'])){
         $SortType = $_POST['SortType'];
     }
     if(isset($_POST['RoundPrice'])){
        $RoundPrice = $_POST['RoundPrice'];
    }
    if(isset($_POST['page'])){
        $page = $_POST['page'];
        $limit = $limit * $page;
    }
    if(isset($_POST['NameSeacher'])){
        $NameSeacher = $_POST['NameSeacher'];
      //  echo "ajax vs tên tìm kiếm : $NameSeacher <br/>";
        $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%$NameSeacher%'";
        
    }
 }
 switch ($RoundPrice) {
     case '2tr':
       $nameButton = 'Dưới 2 triệu';
        $sql = $sql . ' AND `giamoi` <= 2000000';
      
         break;
     
    case '2tr-4tr':
        $nameButton = 'Từ 2 - 4 triệu';
        $sql = $sql . ' AND `giamoi` BETWEEN 2000000 AND 4000000';
         break;
         case '20tr':
            $nameButton = 'Trên 20 triệu';
            $sql = $sql . ' AND `giamoi` >= 20000000';
             break;
             case '4tr-7tr':
                $nameButton = 'Từ 4 - 7 triệu';
                $sql = $sql . ' AND `giamoi` BETWEEN 4000000 AND 7000000';
                 break;
                 case '7tr-13tr':
                    $nameButton = 'Từ 7 - 13 triệu';
                    $sql = $sql . ' AND `giamoi` BETWEEN 7000000 AND 13000000';
                     break;
                     case '13tr-20tr':
                        $nameButton = 'Từ 13 -  20 triệu';
                        $sql = $sql . ' AND `giamoi` BETWEEN 13000000 AND 20000000';
                         break;
 }
 if ($nameButton != ''){
    echo '<button onclick="ResultSeacherSort('.$SortType.', 0, '.$page.');" type="button" class="btn btn-outline-warning">⤫ '.$nameButton.'</button> <br/><br/>';
 }
 if ($SortType == 2){
   // echo 'Sắp xếp giá cao đến thấp'. "<br/>";
   $nameButtonSort = 'Giá cao đến thấp';
    $sql = $sql . ' ORDER BY `nokia`.`giamoi` DESC';

}
 $namedemo = '2tr';
if ($SortType == 3){
    $nameButtonSort = 'Giá thấp đến cao';
  // echo 'Sắp xếp giá thấp đến cao'. "<br/>";
   $sql = $sql . ' ORDER BY `nokia`.`giamoi` ASC';
}
if($nameButtonSort != ''){
    ?>
    <button onclick="ResultSeacherSort(0, '<?=$RoundPrice?>', <?=$page?>);" type="button" class="btn btn-outline-danger">⤫ <?=$nameButtonSort?></button><br/> <br/>
    <?php
}
$CountPage = executeResult($sql);
  $MaximumSatrt = count($CountPage);
  $sql = $sql . ' LIMIT '.$limit.' OFFSET '.$offset.' ' ;
 //  var_dump($sql); die();
 $result = executeResult($sql);
 $MaximumEnd = count($result);
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
     if(($MaximumSatrt - $MaximumEnd) > 0){
     // you need learing more tool Javascript in Ground web API
     // What is API js
     // are API js it can help for you ?
     // And do it can make in design and detail a website 

     ?>
    <center> <a href="javascript: ResultSeacherSort(<?=$SortType?>, <?=$RoundPrice?>, <?=($page + 1)?>);"> <button style="color : blue !important ;
  margin : 40px ;
  border : 1px solid #000000" type="button" class="btn btn-outline-light text-dark">Xem Thêm <?=($MaximumSatrt - $MaximumEnd)?> Sản Phẩm</button> </a></center>
  <?php
  }
  
  ?>