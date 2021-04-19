<?php
session_start();
//var_dump($_SESSION['cart']);
 require_once ('./Help.php');
 if(!empty($_GET)){
   if(isset($_GET['id'])){
      $id = $_GET['id'];
   }
   $sql = 'SELECT * FROM nokia WHERE id = '. $id;
  $result1 = executeSingleResult($sql);
  $sql_image = 'SELECT * FROM `image_library` WHERE `product_id` = '.$id.' ORDER BY `product_id` ASC';
  $result_image = executeResult($sql_image);
  //var_dump($result_image); die();
  //echo count($result_image);
 }
 $sqlVote = 'SELECT * FROM `voteproduct` WHERE `id_product` = '.$id.' ';
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
    $temoarray = $TBCStar/$countVote;
    $temoarray=(int)$temoarray;
   // echo $countVote;
   ///echo  ($TBCStar/$countVote);
//  die();
$totalStar = round($TBCStar/$countVote, 1);
if ($totalStar  == $temoarray){
  $totalStar = $totalStar . ".0";
}
//echo $totalStar;


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
  <style>
     @media only screen and (max-width: 576px) {
        .float-right-cart>a{
      right : 100px !important;
        }
        .float-right-destok {
            display : none !important;
        }
        .Number-oder {
          right : 100px !important;
        }
    }
    @media only screen and (max-width: 1484px) {
      .Float-left, .Float-right{
        display : none ;
      }
    }
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  .Select-introduce img {
      margin-top :17px;
  }
  .Select-introduce {
    width : 220px;
    height : 440px ;
    background : none;
    border : 1px solid #77777733;
    
  }
  .Select-introduce h5,h6,h4 {
       text-align : center;
  }
  .Select-introduce h6 {
    text-decoration: line-through;
    color : #d8d6d6;
  }
  .Select-introduce h5 {
    color : red;
  }
  .container .Select-introduce {
    
   // flex-shrink: 0;
  }
  .h5-aminaze {
     border-bottom : 1px solid #000000;
     width : 100%;
  }
  .news-more-product a,li {
    margin-top : 15px;
  }
  .Float-left h5 {
    padding: 12px;
  }
  .Float-right h5 {
    padding: 12px;
  }
  .page-newspace b {
    color : red;
  }
  .news-image {
    margin-top : 12px;
    margin-right: 11px;
     float : left;
  }
  .title-span {
    color : blue;
    margin-left : 18px;
  }
  .title-h6 {
   
    text-align: left;
    margin-top : 12px;
  }
  .page-newspace {
    width : 100%;
    border-bottom : 1px dotted #000000;
    padding-bottom : 12px;
  }
  .Float-left {
    background : none;
    
     position: absolute;
     margin-left : 2% ;
     top : 70px;
     left : 0px;
     width : 15% ;
     
  }
  .img-sale {
    margin-top : 12px;
  }
  .Float-right{
   
    position: absolute;
     top : 70px;
     margin-right : 2%;
     right : 0px;
     width : 15% ;
    height : 1280px;
  }
  .float-right-cart>a{
      //float : right !important;
      position : absolute;
      right : 55px;
      top : 3px ;
  }
  .carousel-indicators li {
    border-radius : 100%;
    height : 0px;
    width : 15px ;
    background : #910c6fcb;
  }
  .carousel-item img {
    width : 100%;
    height : 100%;
  }
  
   
    @media only screen and (min-width: 992px) {
      .carousel-item img {
        width : 700px;
    height : 400px;
  }
  .carousel {
     width : 700px !important;
  }
  .slide {
    margin-left: 75px;
  }
    }
    @media only screen and (min-width: 1140px) {
      .carousel-item img {
        width : 700px;
    height : 400px;
  }
  .carousel {
     width : 700px !important;
  }
  .slide {
    margin-left: 75px;
  }
    }
    @media only screen and (min-width: 1200px) {
      .carousel-item img {
       // width : 700px;
    height : 400px;
  }
  .slide {
    margin-left: 160px;
  }
 
    }
  
  .pro-product {
    text-align : left !important ;
    color : rgb(94, 87, 87);
    border-top : 1px solid #000000;
    padding: 12px;
  }

  .buy-product {
    width : 100%;
    position : fixed;
    bottom : 30px;
  }
  .buy-product>.btn-danger  {
    width : 85% !important;
  }
  .content-product {
    margin-top : 20px ;
  }
  .add-cart {
    width : 100% ;
    //height : 200px;
    position : fixed;
    bottom : 14px ;
    z-index : 999;
    display : flex;
    justify-content : center;

  }
  .box-cart {
    display : none;
    padding : 4px;
    border-radius : 8px;
    background: rgb(207, 207, 207);
     width : 500px;
     height : 290px;
     
  }
  .content-car button{
    float : right;
    border : 1px solid #000000;
    border-radius : 100%;
    width : 33px;
    height : 33px;
  }
  .content-car {
    margin-top : 5px;
  }
  .box-content-cart img {
   float : left ;
   margin:20px;
   
  }
  .Number-oder {
      width:20px;
      height : 20px;
      border-radius : 100%;
      background: red;
      text-align : center;
      color : white;
      position : absolute;
      right : 55px;
      top : 3px ;
      z-index : 999;
  }
  .cart-order {
    position: fixed;
    top : 82px;
  background: white;
  display: none;
  z-index : 9999;
  }
  .table th {
      text-align : center;
  }
  .Sum-money {
      background : black ;
  }
  .Sum-money td {
      color : white;
  }
  .input-number{
    width : 0px !important;
  }
  .btn-danger, .input-number{
    float : left ;
  }
  .btn-success {
    float  : right;
  }
  .Sum-button {
    width : 130px ;
  }
  @media only screen and (max-width: 576px) {
    .table-bordered {
        position : relative !important;
        left : -10px !important;
    }
    }
  .add-buy-product {
    margin-top : 50px;
    width : 100%;
    height : 900px;
    background-image : url('https://st2.depositphotos.com/3969727/11347/v/950/depositphotos_113476734-stock-illustration-seamless-pattern-shopping-trolley-grocery.jpg');
    background-size: 200px 200px;
  }
  .add-buy-product h3 {
      color : blue;
      padding: 30px;
  }
  .form-group span {
    color : red;
  }
  .Number-oder {
      width:20px;
      height : 20px;
      border-radius : 100%;
      background: red;
      text-align : center;
      color : white;
      position : absolute;
      right : 55px;
      top : 3px ;
      z-index : 999;
  }
  ::-webkit-scrollbar { 
    display: none; 
}
#show-change-product{
  width : 750px ;
}
  .content-product {
    width : 750px ;
  
    height : 900px;
   
  overflow: hidden;
  text-overflow: ellipsis;
  }
  .image-user-comment {
    float : left ;
    padding-top : 6px;
    text-align: center;
      border : 1px solid #000000;
      width : 40px;
      height : 40px;
      background-color: #aaa;
  }
  .comment-parent h6 {
    float : left ;
    margin-left : 12px ;
  }
  .comment-parent{
     margin : 18px 0px 18px 0px ;
  }

  .comment-children {
    
     background-color: #ebebeb;
     width : 100% ;
     padding-bottom : 19px ;
     margin-top : 12px;
     border: 1px solid #c9c9c9;
  }
  .user-comment {
    padding-top : 9px;
    margin-top : 12px ;
    border-top : 1px solid #6b6b6b;
  }
  .ans-chil {
     margin-top : 20px;
  }
  .content-comment {
    width : 750px ;
  }
  .arrow-up {
  width: 0px; 
  height: 0px; 
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  position: relative;
  top : 12px;
  border-bottom: 15px solid #ebebeb;
}
.round-vote{
          float : left;
      }
     
      .Vote-Result {
       
          margin : 30px ;
         float : left;
        
          width: 50%;
      }
      .progress {
          float : left;
          margin : 10px 0px 0px 12px ;
      }
      .voteCartA {
        float : left ;
        margin-left : 15px;
      }
      .roundSum {
          font-size : 50px;
      }
      .SumStar {
          margin-top : 40px;
          border-right : 1px solid #000000;
          width : 140px;
          padding-bottom : 20px;
       float : left;
      }
      #block {
        display : none ;
     
    
      }
      #hident {
        position : relative ;
      
      }
      .YourVote{
        margin-top : 15px;
        float :left;
        position: relative;
        left : -150px;
      }
      div.stars {
  width: 270px;
  display: inline-block;
}
 
input.star { display: none; }
 
label.star {
  float: right;
  padding: 10px;
  font-size: 24px;
  color: #444;
  transition: all .2s;
}
 
input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
 

 

 

 
label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
.stars {
  display : none ;
 top : -40px;
  position: relative;
 left : -35px;
  
}
#HidenVote {
  display: none;
 margin-top: 15px;
}
.FormInput {
  display: none;
  margin-top : 50px;
  
  width : 800px ;
  
  position: relative;
 left : -150px;
  
}
.FormInput .form-group {
  margin  : 4px ;
}
.roundStar {
  position: relative;
        top : 4px;
        
}
.roundStar img {
        float : left ;
        margin-right : 2px;
       
      }
      .compare-product {
        width : 100%;
        height : 510px ;
       
      }
      .compare-h5 {
        margin : 20px;
      }
      .more-compare-product {
        display: flex;
        overflow : auto;
        width : 100%;
      
         height : 450px;
      }
      .product-flex {
      
        width : 220px;
        height : 440px;
        
      }
      .more-compare-product  .product-flex{
        float : left !important;
        flex-shrink: 0;
      }
      .roundStar {
  margin-left : 15px;
}
.roundStar img {
        float : left ;
        margin-right : 2px;
       
      }
      .spanVote {
        position : relative;
        top : 12px;
        left : 12px;
        color : #777777;
      }
  </style>
</head>
<body>
<div class="Float-left">
 
 <center> <h5 class="h5-aminaze" > Tin Tức Mới Nhất</h5></center>

<?php
  $sqlNews = 'SELECT * FROM news LIMIT 5 OFFSET 0';
      $ResultNews = executeResult($sqlNews);
     foreach($ResultNews as $key => $value){
?>
    <div class="page-newspace">
    <i> <b> <?=$value['create_date']?></b></i> <img src="https://i1.wp.com/benhvienungbuoudanang.com.vn/wp-content/uploads/2020/01/new-icon.gif?fit=368%2C333&ssl=1" height="50" width="50">
    <div style="clear:both"></div>
    <img class="news-image" src="<?=$value['image']?>" width="70" height="70">
   <h6 class="title-h6"> <?=$value['title']?></h6>
   <span class="title-span"> <?=$value['description']?></span>
</div>

<?php
     }
?>
<img style="margin : 12px" src="https://www.trasauviettel.com/images/icon/hot-icon-1-1.gif" width="290" height="80">
<img class="img-sale" src="https://file.hstatic.net/1000308219/article/han_ny_fa25436ba9834fa1b08b3c2d035caf6e_1024x1024.jpg" width="100%" height="200">
<img class="img-sale" src="https://msmobile.com.vn/upload_images/images/2019/10/30/tat-lam-moi-ung-dung-trong-nen-tren-iphone-msmobile-6.jpg" width="100%" height="200">
<img class="img-sale" src="https://c.pxhere.com/photos/3d/ed/blurred_background_cellphone_close_up_contemporary_device_display_electronic_gadget-1550613.jpg!d" width="100%" height="200">
<!-- https://bizweb.dktcdn.net/100/188/840/files/5180757-cover-widget.jpg?v=1602389166044 -->
   </div>
   <div class="Float-right">
   <center> <h5 class="h5-aminaze" > Sản Phẩm Mua Nhiều Nhất</h5></center>
   <div class="news-more-product">
  <ul>
    <?php
    $sql = 'SELECT * FROM `selling_products`';
     $result = executeResult($sql);
     $char = '';
     foreach($result as $key => $value){
            $char = $char. $value['id_product']. ",";
     } 
     $char = substr($char, 0, -1);
     if($char == ''){
      $char = 0;
    }
    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') LIMIT 10 OFFSET 0';
    $result =  executeResult($sql);
    foreach($result as $key => $value){
     echo '<a href="product.php?id='.$value['id'].'"> <li> '.$value['name'].'</li></a>';
    }
    
    
    ?>
  </ul>
  <center> <h5 class="h5-aminaze" > Cấu Hình Tốt</h5></center>
  <ul>
    <?php
    //SELECT * FROM `nokia` WHERE `giamoi` >= 7000000 ORDER BY `nokia`.`giamoi` DESC
    $sql = 'SELECT * FROM `nokia` WHERE `giamoi` >= 7000000 ORDER BY `nokia`.`giamoi` DESC LIMIT 10 OFFSET 0';
    $result = executeResult($sql);
    foreach($result as $key => $value){
     echo '<a href="product.php?id='.$value['id'].'"> <li> '.$value['name'].'</li></a>';
    }
    ?>
    
  </ul>
  <center> <h5 class="h5-aminaze" > Đáng Chú Ý</h5></center>
  <ul>
     <?php
    //SELECT * FROM `nokia` WHERE `giamoi` >= 7000000 ORDER BY `nokia`.`giamoi` DESC
    $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 3500000 AND 7000000 LIMIT 10 OFFSET 0';
    $result = executeResult($sql);
    foreach($result as $key => $value){
     echo '<a href="product.php?id='.$value['id'].'"> <li> '.$value['name'].'</li></a>';
    }
    ?>
    
  </ul>
   </div>
   </div>
<div class="container cart-order">
<table id="change-input-Ajax" class="table table-bordered">
</table>
        </div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <div class="float-right-cart">
  <?php
      if(isset($_SESSION['cart']['cart-id']) && count($_SESSION['cart']['cart-id']) > 0){
          echo '<div id="change-count" class="Number-oder">
          <span> '.count($_SESSION['cart']['cart-id']).' </span>
         </div>';
      }
    
    ?>
    <a onclick="AjaxChange1()" href="javascript:;"> <img src="https://laptopwin.com/wp-content/uploads/2018/02/icon-cart-03.png" width="46" height="46"> </a>
    </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>    
    </ul>
    <div class="float-right-cart float-right-destok">
   

    <?php
      if(isset($_SESSION['cart']['cart-id']) && count($_SESSION['cart']['cart-id']) > 0){
          echo '<div id="change-count" class="Number-oder">
          <span> '.count($_SESSION['cart']['cart-id']).' </span>
         </div>';
      }
    
    ?>
    
    <a onclick="AjaxChange1()" href="javascript:;"> <img src="https://laptopwin.com/wp-content/uploads/2018/02/icon-cart-03.png" width="46" height="46"> </a>
    </div>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
    <div style="margin-left : 4%" class="container">
    <h3> <?= $result1['name']?></h3>
    <h5 style="color: red"> <?=number_format($result1['giamoi'], 0, ",", ".")?>đ</h5>
    <img style="margin : 14px" src="<?= $result1['image']?>" width="250" height="250"> 
    <h5 class="pro-product">Đặc điểm nổi bật của  <?= $result1['name']?></h5>
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
   <!-- <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>-->
    <?php
    $n = 0;
     while($n < count($result_image)){
    ?>
         <li data-target="#demo" data-slide-to="<?=$n?>" <?php
            if($n == 0){
              echo 'class="active"';
            }
         ?> </li>
      
    <?php
       $n ++;
     }
    ?>
  </ul>
  
  <!-- The slideshow -->
  
        <div class="carousel-inner">
    <!--<div class="carousel-item active">
      <img src="https://fptshop.com.vn/uploads/images/tin-tuc/120961/Originals/nhieu-ung-dung-ios-cap-nhat-moi-nhung-lai-khong-co-bat-cu-thay-doi-nao-1.jpg" >
    </div>
    <div class="carousel-item">
  <img src="http://hanoimoi.com.vn/Uploads/images/tuandiep/2019/10/06/HNMO_iPhone_11_1st.jpg"  > 
    </div>
    <div class="carousel-item">
  <img src="https://cdn-ak.f.st-hatena.com/images/fotolife/n/nguyentrinh67/20191219/20191219175634.jpg" >
    </div> -->
     <?php
        foreach($result_image as $key){
          echo '';
        }
        for($i = 0; $i < count($result_image); $i++){
      ?>
<div class="carousel-item <?php
 if($i == 0){
   echo 'active';
 }
?>">
      <img src="<?=$result_image[$i]['path']?>" >
    </div>
        
      <?php 
       }
     ?>
  </div>
  
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>
  
</div> 
<div id="show-change-product">
<div class="content-product">
  <?=$result1['content']?>
</div>
<button data-id="<?=$id?>" style="background:none;color : blue;margin : 12px" type="button" class="btn btn-primary moreContent">Đọc thêm</button> 
      </div>
      <div class="compare-product">
        <?php
         // var_dump($result1['giamoi']); die();
         $PriceStar = $result1['giamoi'] - 2000000;
         $PriceEnd = $result1['giamoi'] + 2000000;
         if(($result1['giamoi'] -  2000000) <= 0){
          $PriceStar = $result1['giamoi'];
         }
     //   echo "Giá nhỏ nhất : $PriceStar ------ giá lớn nhất : $PriceEnd"; die();

        ?>
      <h5 class="compare-h5">So sánh với các sản phẩm tương tự</h5>
      <div class="more-compare-product">
        <?php
         //$SqlCompare = 'SELECT * FROM nokia LIMIT 10 OFFSET 0';
         $SqlCompare = 'SELECT * FROM `nokia` WHERE `id` != '. $id.' AND `giamoi` BETWEEN '.$PriceStar.' AND '.$PriceEnd.' LIMIT 10 OFFSET 0';
         //var_dump($SqlCompare); die();
        
         $ResultCompare = executeResult( $SqlCompare );
        foreach($ResultCompare as $key => $value){
        ?>
<div class="product-flex">
<div class="Select-introduce">
         <center> <img src="<?=$value['image']?>" width="170" height="170"></center>
         <h4> <?=$value['name']?> </h4>
         <h6> <?=number_format($value['giacu'], 0, ",", ".")?>đ</h6>
         <h5> <?=number_format($value['giamoi'], 0, ",", ".")?>đ</h5>
         <center> <a href="product.php?id=<?=$value['id']?>"><button style="float:none !important" type="button" class="btn btn-success">Xem chi tiết</button></a></center>
         <center> <button onclick="AddCart(<?=$value['id']?>)" style="margin-top : 12px" type="button" class="btn btn-warning">Thêm Vào Giỏ Hàng</button></center>
         <?php    
           $sqlVote1 = 'SELECT * FROM `voteproduct` WHERE `id_product` = '.$value['id'].' ';
           $resultVote1 = executeSingleResult($sqlVote1);
           
           $countVote1 = 0;$test1 = 0;
           $TBCStar1 = 0;$Star1 = 1;
              foreach($resultVote1 as $key){
                  if( $test1 < 2){
                      $test1 ++;
                      continue ;
                  }
                  //echo  $key. "   ";
                  $TBCStar1 =  $TBCStar1 + ($Star1 * $key); 
                  $Star1 ++;
                  $countVote1 = $countVote1 +  $key;
              }
             
         
         ?>
     <?php
      if($countVote1 != 0){
        $temoarray1 = $TBCStar1/$countVote1;
       ?>

<a href="product.php?id=<?=$value['id']?>">  <div class="roundStar">
        <?php
      
        $j = 1;
            //echo $value['vote'];
            
            for(; $j <= $temoarray1; $j ++){
      ?>
       
    <img src="https://i.pinimg.com/originals/79/0c/e5/790ce50a0d73665b9b657fc0dbb9c552.png" width="14" height="14">
    
  
  <?php } if ($j <= 5){
     for (;$j <= 5; $j ++){
       echo '<img src="https://image.flaticon.com/icons/png/512/69/69495.png" width="14" height="14">';
     }
  }
   
        ?>
         <span class="spanVote">  <?=  $countVote1 ?> đánh giá</span>
       </div></a>
       <?php
       } 
     ?>
     </div>
      </div>


        <?php } ?>
     
      </div>
      </div>
<!-- Content comment a product in come here -->
<div style="border: 1px solid #000000; width : 100%;
      margin : 40px;"></div>
   <h5 id="contentAvote"> <?=$countVote?> Đánh giá về <?= $result1['name']?></h5>
   <div style=" margin : 12px">
    <div class="SumStar">
    <div class="roundSum">
    <span style="position : relative;top : 6px; color : orange"> <?=$totalStar?></span>
    <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="45" height="45">
    </div>

    </div>
  <div class="Vote-Result">
    <?php
    $test = 0;
    $i = 1;
      foreach($resultVote as $key){
         
        if( $test < 2){
            $test ++;
            continue ;
        }
        
    ?>
     <div class="round-vote">
    <span> <?=$i?> <img src="http://simpleicon.com/wp-content/uploads/star.png" width="17" height="17"></span>
    </div>
    <div class="progress" style="height:5px; width : 30%">
    <div class="progress-bar bg-warning" style="width:<?=(100/$countVote) * $key?>%;height:5px"></div>
    
  </div>
  <div class="voteCartA">
  <a href="javascript:rounting(<?=$id?>, <?=$i?>);" href=""> <?=$key?> Đánh giá</a>
  </div>
  <div style="clear:both"></div>
   <?php $i ++;}?>
   <div class="YourVote">
<a id="hident" href="javascript:hident();"> <button type="button" class="btn btn-primary">Gửi đánh giá của bạn </button></a>
<a id="block" href="javascript:closeNone();"> <button type="button" class="btn btn-light">Đóng lại</button> </a>
</div>
<div style="clear: both"></div>
<div id="HidenVote">
<span style="float : left;
position: relative;
 left : -140px;"> Chọn đánh giá của bạn</span>
 <span style="margin-left : 75px" id="temp"> </span> <br/>
<div class="stars">

    <form  name="checkFormVote" action="" method="POST" onsubmit="return validateFormVote(<?=$id?>)" >
 
    <input  class="star star-5" value="5" id="star-5" type="radio" name="star"/>
    <label class="star star-5"    for="star-5"></label>
    <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
    <label class="star star-1" for="star-1"></label>
    <span id="temp"> </span> <br/>
    <div class="FormInput"> 
    <div style="float : left;
    width : 360px;
    " class="form-group">
  <textarea  class="form-control" placeholder="Nhập đánh giá về sản phẩm (tối thiểu 80 ký tự)" rows="5" id="comment" name="note"></textarea>
</div>
    <div style="float : left;
    width : 180px" class="form-group">
    <input name="name" type="text" class="form-control" placeholder="Họ tên" >
  </div> 
 
  <div style="float : left;
    width : 180px" class="form-group">
    <input name="numberphone" type="number" class="form-control" placeholder="Số điện thoại" >
  </div>
 
  <div style="float : left;
    width : 180px" class="form-group">
    <input name="email" type="email" class="form-control" placeholder="Email" >
  </div>
  <button style=" width : 180px; margin : 5px"type="submit" class="btn btn-primary">GỬI ĐÁNH GIÁ</button>
  <div style="clear : both"></div>
  <span id="errorFormVote" style="color : red"> * Vui lòng nhập đầy đủ các trường</span>
  </div>
  
  </form>

</div>
</div>
</div>

</div>
<div id="changeCommentParent" class="content-comment">
    
<div style="clear : both"></div>
   <?php
   
   if(!empty($_GET)){
    if(isset($_GET['id'])){
       $id = $_GET['id'];
       $sql = 'SELECT * FROM `comment` WHERE `id_product` = '.$id.'';
   // $sql = 'SELECT * FROM `comment` WHERE `id_product` = 308 AND `id_parent` = 0 LIMIT 10 OFFSET 0';
       $limitComment = 10 ;
       $result = executeResult($sql);
       $result_data = ReturnDataComment($result, 0, 0);
       $DetailComment = 0;
    //  var_dump($result_data); die();
       foreach($result_data as $key => $value){
         if($value['lever'] == 0){
          if( $DetailComment == $limitComment){
              break;
         }
          $DetailComment ++;
          $name = $value['name_user_comment'];?>
  <div class="comment-parent">
        <div class="image-user-comment"> <b><?=$name[0]?></b></div>
        <h6> <b> <?=$name?> </b></h6>
        <div style="clear : both"></div>
        <div class="roundStar">
        <?php
        if ($value['vote'] != null){
            //echo $value['vote'];
            
            for($i = 1; $i <= $value['vote']; $i ++){
      ?>
       
    <img src="https://i.pinimg.com/originals/79/0c/e5/790ce50a0d73665b9b657fc0dbb9c552.png" width="14" height="14">
    
  
  <?php }}
   
        ?>
        </div>
        <h7> <?=$value['content_comment']?> </h7>
  <br/> <a href="javascript:;" onclick="ShowCmtChildren(<?=$value['id']?>, 'dom', <?=$value['id']?>, <?=$id?>)">Trả lời - </a>
  <a style="margin-left :16px" href="javascript:;"> Hữu ích</a>
  <h8 style="margin-left:18px">- 12/02/2021</h8>
 
         <?php 
         $id_parent = $value['id'];
         $count = 0;
         foreach($result_data as $key1 => $value1){
            if ( $id_parent == $value1['id_parent']){
                  $name1 = $value1['name_user_comment'];
                if ($count == 0){ echo '  <div class="arrow-up"></div>';
                  echo '<div  class="comment-children">';}
          ?>
                   <div <?php if($count == 0) echo 'style="border-top : none"' ;?> class="user-comment">
     <div class="image-user-comment"> <b><?=$name1[0]?> </b></div>
    <h6> <b> <?=$name1?> </b></h6>
   
        <div style="clear : both"></div>
        <div class="roundStar">
        <?php
        if ($value1['vote'] != null){
            //echo $value['vote'];
            
            for($i = 1; $i <= $value1['vote']; $i ++){
      ?>
       
    <img src="https://i.pinimg.com/originals/79/0c/e5/790ce50a0d73665b9b657fc0dbb9c552.png" width="14" height="14">
    
  
  <?php }}
   
        ?>
        </div>
        <h7><?=$value1['content_comment']?></h7>
  <br/> <a href="javascript:;" onclick="ShowCmtChildren(<?=$value1['id_parent']?>, 'dom', <?=$value['id']?>, <?=$id?>)">Trả lời - </a>
  <a style="margin-left :16px" href="javascript:;"> Hữu ích</a>
  <h8 style="margin-left:18px">- 12/02/2021</h8>
  </div>

<?php
                 $count ++;
             }
            
          }
          if ($count != 0){echo '</div>';}
         echo '<div id="'.$value['id'].'" class="ans-chil"></div>';
         
         
         ?>
  </div>
  
 <?php }
 }
}
}?>
<ul class="pagination">
<?php
  $QuanlityPage = 'SELECT * FROM `comment` WHERE `id_product` = '.$id.' AND `id_parent` = 0';
  $ResultQltt = executeResult($QuanlityPage);
  $SumPageQtl = count($ResultQltt) / 10;
 // echo count($ResultQltt) . "<br/>";
  //echo $SumPageQtl;
 for ($i = 1; $i <= $SumPageQtl; $i ++){
      echo '<li class="page-item"><a class="page-link" onclick="Void('.$id.', '.$i.')" href="#changeCommentParent">'.$i.'</a></li>';
 }
?>
</ul>

  <form name="checkForm" action="" method="POST" onsubmit="return validateForm('UpdateParent', <?=$id?>, '-1')" >
  <div class="form-group">
    <label >Nhập tên của bạn:</label>
    <br/><span id="error-name"> * Bắt buộc nhập </span>
    <input name="username" type="text" class="form-control" placeholder="Enter your name" >
    <br/><span id="error-comment"></span>
  </div>
  <div class="form-group">
  <textarea name="comment" placeholder="Mời Bạn Để Lại Bình Luận ..." class="form-control" rows="5" id="comment"></textarea>
</div>
<button  type="submit" class="btn btn-primary">Gửi</button>
</form>
</div> 


<div style="margin : 700px"></div>
<div class="container buy-product">

<button onclick="AddCart(<?=$result['id']?>)"type="button" class="click-buy btn btn-danger">Mua Ngay</button>

</div>



</div>
<div style="position : fixed !important;
left:-15px !important;" class="container">
<div class="add-cart">
   <div class="box-cart">
       <div class="content-car">
         <img src="https://cdn0.iconfinder.com/data/icons/shift-free/32/Complete_Symbol-512.png" width="30" height="30">
         <span>Sản phẩm đã được thêm vào giỏ hàng</span>
         <button class="click-close" type="text" > X </button>
       </div>
       <div class="box-content-cart">
            <img  src="<?=$result['image']?>" width="140" height="150">
            <div style="float: left ;
             margin:20px 0px 0px 12px;">
            <h4> <?=$result['name']?></h4>
            <h6 style="color : red"> <?=number_format($result['giamoi'], 0, ",", ".")?> đ</h6>
            </div>
       </div>
      <center> <a href="cart.php"><button style="width : 100%" type="button" class="btn btn-danger">Xem Giỏ Hàng</button></a> </center>
   </div>
  </div>
  </div>
  <!--

  
   -->
<script type="text/javascript">
//moreContent
$(document).ready(function(){

$('.moreContent').on('click',function(){
  var temp = $(this).attr("data-id");
  $.post('MoreContent.php', {
                       'id' : temp
                      }, function(data){
                        document.getElementById("show-change-product").innerHTML = data;
                      })
 }) ;
 
 
}) ;
function Void(id, page) {
  $.post('pagecomment.php', {
                       'id' :id,
                       'page' : page,
                      }, function(data){
                       
                        document.getElementById("changeCommentParent").innerHTML = data;
                       
                        
                      })
}
function rounting(id, vote){
   console.log(id);
   console.log(vote);
   $.post('AjaxComment.php', {
                       'id' :id,
                       'routing' : vote,
                      }, function(data){
                        $('#hident').fadeIn(5);
                    $('#block').fadeOut(1200);
                     $('#HidenVote').fadeOut(1200);
                        document.getElementById("changeCommentParent").innerHTML = data;
                       
                        
                      })
}
 function validateFormVote(id_product){
  
    var vote = document.forms["checkFormVote"]["star"].value;
    var NumberPhone = document.forms["checkFormVote"]["numberphone"].value;
    var Name = document.forms["checkFormVote"]["name"].value;
    var Email = document.forms["checkFormVote"]["email"].value;
    var Note = document.forms["checkFormVote"]["note"].value;
    var error = '';
    if(NumberPhone == ''){
      error = '* Điện thoại không được để trống';
    }
    if(Name == ''){
      error = '* Tên không được để trống'; 

    }
    if(Email == ''){
       error = '* Email không được để trống';  
    }
    if(Note == ''){
      error = '* Nội dung không được để trống'; 
    }
    if (error != ''){
      document.getElementById("errorFormVote").innerHTML = error;
      return (false);
    }
   /* console.log(id_product);
    console.log(vote);
    console.log(NumberPhone);
    console.log(Name);
    console.log(Email);
    console.log(Note); */
  
    $.post('AjaxComment.php', {
                       'vote' :vote,
                       'id_product' : id_product,
                       'NumberPhone' : NumberPhone,
                       'Email': Email,
                       'Name' : Name,
                       'Note' : Note
                      }, function(data){
                        $('#hident').fadeIn(5);
                    $('#block').fadeOut(1200);
                     $('#HidenVote').fadeOut(1200);
                        document.getElementById("changeCommentParent").innerHTML = data;
                        location.reload() ;
                        
                      })




    //console.log('hahah');
     return (false);
  }
 $(document).ready(function(){
  
$('#star-5').on('click',function(){
  document.getElementById("temp").innerHTML = 'Rất Tốt'; 
 }) ;
 $('#star-4').on('click',function(){
  document.getElementById("temp").innerHTML = 'Tốt'; 
 }) ;
 $('#star-3').on('click',function(){
  document.getElementById("temp").innerHTML = 'Bình thường'; 
 }) ;
 $('#star-2').on('click',function(){
  document.getElementById("temp").innerHTML = 'Tệ'; 
 }) ;
 $('#star-1').on('click',function(){
  document.getElementById("temp").innerHTML = 'Rất tệ'; 
 }) ;
$('.star').on('click',function(){
  $('.FormInput').fadeIn(5);
 }) ;
}) ;
 function hident(){
  $('#block').fadeIn(5);
  $('#hident').fadeOut(5);
  $('#HidenVote').fadeIn(5);
  //HidenVote
  //console.log('hshshshhs');
 }
 function closeNone(){
  $('#hident').fadeIn(5);
  $('#block').fadeOut(5);
  $('#HidenVote').fadeOut(5);
 }
      </script>
  <script type="text/javascript">
  function ShowCmtChildren(id_parent, action, id_Dom, id){
       //console.log(id_parent);
      // console.log(action);
      // console.log(id_Dom);
       if (action == 'dom'){
       // document.getElementById(id_Dom).innerHTML = 'Hiện lên in put';
       $.post('AjaxComment.php', {
                       'action' :id_Dom,
                       'id' : id
                      }, function(data){
                       
                        document.getElementById("changeCommentParent").innerHTML = data;
                     
                      })
       }
  }
  function UploadCmt( id, id_parent){
    var comment = document.forms["checkForm"]["comment"].value;
    var Length = comment.length;
    var username = document.forms["checkForm"]["username"].value;
    var ErrorName = '';
    var ErrorComment = '';
    //console.log(comment);
   // console.log(username);
    // console.log(id);
     // console.log(id_parent);
      if((comment == '') || (username == '') || Length < 6){
        if (Length < 6){
      ErrorComment = '* Nội dung quá ngắn';
    }
        if(comment == ''){
           ErrorComment = '* Nội dung không được để trống';
        }
       
        if(username == ''){
          ErrorName = '* Tên không được để trống';
        }
        
        if ((ErrorName != '' || ErrorComment != '')){
          document.getElementById("error-name-1").innerHTML = ErrorName;
          document.getElementById("error-comment-1").innerHTML =  ErrorComment;
          return (false);
        }
        
    }
   // console.log('ssfsdfsdf');
    $.post('AjaxComment.php', {
       'username' : username,
                 'comment' : comment,
                 'action' : 'UpdateChildren',
                 'id' : id,
                 'id_parent' : id_parent
                      }, function(data){
                         document.getElementById("changeCommentParent").innerHTML = data;
                      })
     return(false);
  }
  function validateForm(action, id){
    var comment = document.forms["checkForm"]["comment"].value;
    var Length = comment.length;
    var username = document.forms["checkForm"]["username"].value;
    var ErrorName = '';
    var ErrorComment = '';
    if((comment == '') || (username == '') || Length < 6){
      if (Length < 6){
      ErrorComment = '* Nội dung quá ngắn';
    }
        if(comment == ''){
           ErrorComment = '* Nội dung không được để trống';
        }
       
        if(username == ''){
          ErrorName = '* Tên không được để trống';
        }
       
        if ((ErrorName != '' || ErrorComment != '')){
          document.getElementById("error-name").innerHTML = ErrorName;
          document.getElementById("error-comment").innerHTML =  ErrorComment;
          return (false);
        }
        
    }
   
   // console.log(username);
  //  console.log(comment);
   //  console.log(action);
   //  console.log(id);
     $.post('AjaxComment.php', {
       'username' : username,
                 'comment' : comment,
                 'action' : 'UpdateParent',
                 'id' : id
                      }, function(data){
                         document.getElementById("changeCommentParent").innerHTML = data;
                         
                      })
     return (false);
  }
    function AjaxChange1(){
     // $('.cart-order').slideToggle(700);
     $('.cart-order').slideToggle(200);
             console.log('ssssff');
             $.post('demoAjax.php', {
                       
                }, function(data){
                
                   document.getElementById("change-input-Ajax").innerHTML = data;
                })
        }
        </script>
         <script type="text/javascript">
  
  function AjaxChange(quanlity, product){
         //  console.log(quanlity);
           $.post('demoAjax.php', {
                      'id': quanlity,
                      'product' : product
              }, function(data){
               //   alert(data) ;
                 //  location.reload() ;
                 document.getElementById("change-input-Ajax").innerHTML = data;
              })
      }
 function press(fieldName, type, product){
 //console.log(product);
  
      var input = $("input[name='"+fieldName+"']");
    
      var currentVal = parseInt(input.val());
    
      if (!isNaN(currentVal)) {
         
         
        
              var minValue = parseInt(input.attr('min')); 
              if(!minValue) minValue = 1;
              if(currentVal > minValue) {
                  input.val(currentVal - 1).change();
              } 
              if(parseInt(input.val()) == minValue || currentVal == 1) {
                $(".btn-number[data-type='minus'][name='"+product+"']").attr('disabled', true);
              }
        //  console.log(minValue);

             var mintouch = (currentVal - 1);
             if(mintouch != 0){
            AjaxChange(mintouch, product);
            }
          
      } else {
          input.val(0);
      }
     
}
function next(fieldName, type, product){
 
  var input = $("input[name='"+fieldName+"']");
    
    var currentVal = parseInt(input.val());
  
    if (!isNaN(currentVal)) {
       
      var maxValue = parseInt(input.attr('max'));
            if(!maxValue) maxValue = 10;
              if(currentVal < maxValue) {
                  input.val(currentVal + 1).change();
              }
            
              if(parseInt(input.val()) == maxValue) {
           
               $(".btn-number[data-type='plus'][name='"+product+"']").attr('disabled', true);

              }
         
            
            var maxtouch = (currentVal + 1);
            if(maxtouch != 0){
            AjaxChange(maxtouch, product);
            }
        
    } else {
        input.val(0);
    }
 
} 
function ChangeInput(minValue, maxValue, name, progh, valueCurrent){
      if(!minValue) minValue = 1;
      if(!maxValue) maxValue = 10;
      AjaxChange(valueCurrent, progh);
      if(valueCurrent >= minValue) {
    //    console.log(valueCurrent);
          $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
      } else {
          $(this).val($(this).data('oldValue'));
      }
      if(valueCurrent <= maxValue) {
       
          $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
      } else {
          $(this).val($(this).data('oldValue'));
      }
}
</script>
  <script>
    $(document).ready(function(){

$('.click-buy').on('click',function(){
    $('.box-cart').toggle(200);    
 }) ;
 $('.click-close').on('click',function(){
    $('.box-cart').toggle(200);    
 }) ;
 
}) ;
  </script>
  <script type="text/javascript">
          function AddCart(id){
                $.post('AddCart.php', {
                        'id': id 
                }, function(data){
                  document.getElementById("change-count").innerHTML = data;
                  document.getElementById("change-count").innerHTML = data;
                })
          }
       </script>
</body>
</html>
