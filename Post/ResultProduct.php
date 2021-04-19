<?php
  session_start();
  if(isset( $_SESSION['order'])){
   // var_dump( $_SESSION['order']);
   //SELECT * FROM `nokia` WHERE `name` LIKE '%samsung%' ORDER BY `nokia`.`giamoi` ASC
  }
  require_once ('./Help.php');
  $id = $_GET['id'];

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
  <style>
      .checked  {
  background: pink !important;
}
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
    @media only screen and (min-width: 576px) {
      .cart-order {
   margin-left : 50px;
  }
    }
    @media only screen and (min-width: 768px) {
      .cart-order {
   margin-left : 50px;
  }
    }
    @media only screen and (min-width: 992px) {
      .cart-order {
   margin-left : 50px;
  }
    }
    @media only screen and (min-width: 1140px) {
      .cart-order {
   margin-left : 80px;
  }
    }
    @media only screen and (min-width: 1200px) {
      .cart-order {
   margin-left : 15%;
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
    border : 1px solid #000000;
    border-radius : 5px ;
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
    float : left ;
   margin :8px ;
  }
 
  .float-right-cart>a{
      
      position : absolute;
      right : 55px;
      top : 3px ;
  }
  .alert-dismissible {
    position : fixed;
    top : 40px;
    z-index : 999;
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
 a>.login-user {
   padding: 8px 12px 0px 12px;
  text-align: center ;
    vertical-align: middle;
    border-radius: 30px;
    width: auto;
    height : 40px;
    background: #d8d6d6;
    position: relative;
    right : 70px;
    margin-top: 6px;
    color :#000000;
  }
   .login-user:hover{
    
    color : red;
  }
  a:hover {
    text-decoration: none;
  }
  .login-user h3 {
 
    color: #000000;
   
  }

  .cart-order {
    position: fixed;
   
    top : 52px;
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
      //  position : relative !important;
     //   left : -10px !important;
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
      position : fixed;
      right : 55px;
      top : 3px ;
      z-index : 999;
  }
  .float-right-cart {
    z-index : 1000;
  }
  .Flex-full_Screen {
     background:  #0000008a;
     position: fixed;
     width: 100%;
     height : 1280px ;
     z-index : 999;
     display : none;
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
  .content-cart-newCss {
    width: 100%;
  height: 700px;
  overflow-y: auto;
}
::-webkit-scrollbar { 
    display: none; 
}
.form-input-seach {
    position : relative ;
    top : 9px;
}
.result-seacher {
  z-index : 999;
 position : absolute; top : 60px; background : #f1f1f1;
 left : 240px;
 width: 20%;

 border-radius : 5px;
}
.product-result-seacher {
  border-bottom: 1px dotted #000000;
  width:100%;
  height : 80px;
}
.btn-outline-ligh {
  color : blue !important ;
  margin : 50px ;
}
.carousel-indicators li {
    border-radius : 100%;
    height : 0px;
    width : 10px ;
    background : black;
  }
  .carousel-item img {
    width : 100%;
    height : 160px;
  }
.SelectMenu {
  width: 62%;
  float : left ;
  margin : 12px;
  display: flex;
  overflow : auto;
  height : 40px;
}
.MenuTab {
  margin-right : 8px;
 
  flex-shrink: 0;
  
}
.checked  {
  background: orange !important;
  color : white !important;
}
.btn-outline-success {
    width : 175px !important ;
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
      .dropdown {
  float : right;
  margin : 12px;
}
.slidePrice {
  
  flex-shrink: 0;
  margin-right : 14px;
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
  </style>
</head>
<body>
  <div onclick="AjaxChange1()" class="Flex-full_Screen"></div>
<div class="container cart-order">
<div class="content-cart-newCss">
<table id="change-input-Ajax" class="table table-bordered">
</table>
</div>
        </div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <a class="navbar-brand" href="#">Navbar</a>
  
  <div class="float-right-cart">
  <?php
        if(isset($_SESSION['order'])){
           echo ' <a href="login.php"> <div class="login-user">
           <img style="float:left ;
           position : relative;
           top : -12px;" src="https://static.thenounproject.com/png/1081856-200.png" width="50" height="50">  '.$_SESSION['order']['username'].'
     
           </div></a>';
        } else {
          echo ' <a href="login.php"> <div class="login-user">
          Đăng Nhập
       </div></a>';
        }
      
      
      ?>
  <?php
      if(isset($_SESSION['cart']['cart-id']) && count($_SESSION['cart']['cart-id']) > 0){
          echo '<div class="Number-oder">
          <span> '.count($_SESSION['cart']['cart-id']).' </span>
         </div>';
      }
    
    ?>
 
    <a style=" position: fixed;
      right : 53px ;"onclick="AjaxChange1()" href="javascript:;"> <img src="https://laptopwin.com/wp-content/uploads/2018/02/icon-cart-03.png" width="46" height="46"> </a>
   
    </div>
    
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="login.php">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>    
    </ul>
    <form class= "form-input-seach" action="">
  <div style="float: left;width : 200px;margin-right : 15px; margin-left:15px" class="form-group">
    <input style="border-radius : 30px;" type="text" class="form-control" placeholder="Enter Name Product" onkeyup="showHint(this.value)" id="email">
  </div>
  <button style="float : right" type="submit" class="btn btn-primary">Tìm Kiếm</button>
</form>

<div class="result-seacher" > <div id="txtHint"></div></div>
    <div class="float-right-cart float-right-destok">
   <!-- <a href="login.php"> <div class="login-user">
        <centter> <h3 style="font-size: 16px"> Đăng Nhập</h3></centter> 
      </div></a> -->
      <?php
        if(isset($_SESSION['order'])){
           echo ' <a href="login.php"> <div class="login-user">
           <img style="float:left ;
           position : relative;
           top : -12px;" src="https://static.thenounproject.com/png/1081856-200.png" width="50" height="50">  '.$_SESSION['order']['username'].'
     
           </div></a>';
        } else {
          echo ' <a href="login.php"> <div class="login-user">
          Đăng Nhập
       </div></a>';
        }
      
      
      ?>
   <!--   <a href="login.php"> <div class="login-user">
      <img style="float:left ;
      position : relative;
      top : -12px;" src="https://static.thenounproject.com/png/1081856-200.png" width="50" height="50">  sdgsfsffsfsfdfdasdf

      </div></a> -->
    <div id="demo" class="Number-oder">
          <?php
           if(isset($_SESSION['cart'])){
            $SumQuanlity = 0;
            //  var_dump($_SESSION['cart']['cart-number']);
            foreach($_SESSION['cart']['cart-number'] as $key){
         $SumQuanlity = $SumQuanlity + $key;
            }
            echo '<span> '.$SumQuanlity.'</span>' ;
          }?>
         </div>
   
    
    <a style=" position: fixed;
      right : 52px ;" onclick="AjaxChange1()" href="javascript:;"> <img  onclick="AjaxChange()" src="https://laptopwin.com/wp-content/uploads/2018/02/icon-cart-03.png" width="46" height="46"> </a>
    </div>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
<!--<div id="cause" class="carousel slide" data-ride="carousel">


<ul class="carousel-indicators">
  <li data-target="#cause" data-slide-to="0" class="active"></li>
  <li data-target="#cause" data-slide-to="1"></li>
  <li data-target="#cause" data-slide-to="2"></li>
</ul>


<div class="carousel-inner">
  <div class="carousel-item active">
    <img src="https://cdn.tgdd.vn/2021/03/banner/800-170-800x170-19.png" >
  </div>
  <div class="carousel-item">
    <img src="https://cdn.tgdd.vn/2021/03/banner/800-170(1)-800x170.png" >
  </div>
  <div class="carousel-item">
    <img src="https://cdn.tgdd.vn/2021/03/banner/S21-800-170-800x170-2.png" >
  </div>
</div>


<a class="carousel-control-prev" href="#cause" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#cause" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>
</div>-->
<div id="cause" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
   <!-- <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>-->
    <?php
    $sql = 'SELECT * FROM endow';
    $result_image = executeResult($sql);
   // var_dump($result_image);die();
    $n = 0;
     while($n < count($result_image)){
    ?>
         <li data-target="#cause" data-slide-to="<?=$n?>" <?php
            if($n == 0){
              echo 'class="active"';
            }
         ?> </li>
      
    <?php
       $n ++;
     }
    ?>
  </ul>
  

  
        <div class="carousel-inner">
   
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
      <a href="<?=$result_image[$i]['link']?>"> <img src="<?=$result_image[$i]['image']?>" ></a>
    </div>
        
      <?php 
       }
     ?>
  </div>
  
  <a class="carousel-control-prev" href="#cause" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#cause" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>
  
</div> 
<div class="SelectMenu">
<!-- <button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button>
<button type="button" class="btn btn-outline-primary MenuTab">Primary</button> -->
<?php
  $sql = 'SELECT * FROM `menu` WHERE `parent_id` = 0 ORDER BY `parent_id` ASC';
  $result = executeResult($sql);
  foreach($result as $key => $value){
    ?>


    <a href="ResultProduct.php?id=<?=$value['id']?>"><button type="button" class="<?php
    if ($_GET['id'] == $value['id']){
        echo 'checked' ;
    }
    
    
    ?> btn btn-outline-primary MenuTab"><?=$value['name']?></button></a>



<?php  } ?>
 
 
 
</div>
<div >
<div class="SelectMenu">
    <?php
     $id = $_GET['id'];
     $sql = "SELECT * FROM `menu` WHERE `parent_id` = $id ORDER BY `parent_id` ASC";
    $result =  executeResult($sql);
     foreach ($result as $key => $value){
         echo '<a href="javascript:productRounting('.$value['id'].', '.$_GET['id'].');"><button type="button" class="btn btn-outline-success MenuTab">'.$value['name'].'</button></a>';
     }?>
</div>
<div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Sắp xếp
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="javascript:Sortprice(1);">Giá cao đến thấp</a>
      <a class="dropdown-item" href="javascript:Sortprice(2);">Giá Thấp đến cao</a>
     
    </div>
  </div>
  
<div id="change-price-result" class="SelectMenu">
  <p class="slidePrice">Chọn mức giá:</p>
    <a class="slidePrice" href="javascript:SortingPriceAjax('2tr','null', <?=$id?>);">Dưới 2 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('2tr-4tr','null', <?=$id?>);">Từ 2 - 4 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('4tr-7tr','null', <?=$id?>);">Từ 4 - 7 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('7tr-13tr', 'null',<?=$id?>);">Từ 7 - 13 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('13tr-20tr','null', <?=$id?>);">Từ 13 - 20 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('20tr','null', <?=$id?>);">Trên 20 triệu</a>
  
</div>
    </div><br/><br/>
<div style="clear : both"></div>
<?php
 if(!empty($_GET)){
    if(isset($_GET['price'])){
        if ($_GET['price'] == '2tr'){
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
}
    }
 }


?>
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
    <div id="page-address" style="margin-left : 4%" class="container">
    <?php
    $nameResult = 'SELECT * FROM menu WHERE id = '.$_GET['id'];
    $Execute = executeSingleResult($nameResult);
    $Execute['id'];
   
    $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%'";
    

    //SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 3000000 AND 9000000
   //SELECT * FROM `nokia` WHERE `giamoi` < 5000000
    if(!empty($_GET)){
     if(isset($_GET['price'])){
          if ($_GET['price'] == '2tr'){
            //$sql = 'SELECT * FROM `nokia` WHERE `giamoi` < 2000000';
             $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%' AND `giamoi` < 2000000 ";
          }
          if ($_GET['price'] == '2tr-4tr'){
           //  $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 2000000 AND 4000000';
             $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%' AND `giamoi` BETWEEN 2000000 AND 4000000 ";
         }
         if ($_GET['price'] == '4tr-7tr'){
          // $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 4000000 AND 7000000';
          $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%' AND `giamoi` BETWEEN 4000000 AND 7000000 ";
         }
         if ($_GET['price'] == '7tr-13tr'){
           //$sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 7000000 AND 13000000';
           $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%' AND `giamoi` BETWEEN 7000000 AND 13000000 ";
         }
         if ($_GET['price'] == '13tr-20tr'){
          // $sql = 'SELECT * FROM `nokia` WHERE `giamoi` BETWEEN 13000000 AND 20000000';
          $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%' AND `giamoi` BETWEEN 13000000 AND 20000000 ";
         }
         if ($_GET['price'] == '20tr'){
          // $sql = 'SELECT * FROM `nokia` WHERE `giamoi` > 20000000';
           $sql = "SELECT * FROM `nokia` WHERE `name` LIKE '%".$Execute['name']."%' AND `giamoi` > 20000000 ";
           
         }
     }
   }
    $result = executeResult($sql);
    echo '<div id="change-content-product">';
     foreach ($result as $key => $value){
    /*   if ($key == 4){
         break ;
       }*/
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
    </div>
    </div>
      <div style="clear : both"></div>
   
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
       <div id="Add-cart-change" class="box-content-cart">
            <img  src="https://cdn.tgdd.vn/Products/Images/42/153856/iphone-xi-do-600x600-200x200.jpg" width="140" height="150">
            <div style="float: left ;
             margin:20px 0px 0px 12px;">
            <h4> 12345d</h4>
            <h6 style="color : red"> <?=number_format(12000000, 0, ",", ".")?> đ</h6>
            </div>
       </div>
     
      <center> <a href="cart.php"><button style="width : 100%" type="button" class="btn btn-danger">Xem Giỏ Hàng</button></a> </center>
   </div>
  </div>
  
  </div>
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
function SortingPriceAjax(price,id_category_sort, id_category){
  /* console.log(price);
  console.log(id_category);
  console.log(id_category_sort);return(0);*/
   //SortResult.phpreturn 
   //return (0);
   $.post('SortResult.php', {
                        'price': price,
                        'id_category' :  id_category,
                        'id_category_sort' : id_category_sort
                }, function(data){
                  document.getElementById("change-content-product").innerHTML = data;
                })
}
function productRounting(id, id_product){
 // console.log(id);
  $.post('selectMenu.php', {
                        'id': id,
                        'id_product' : id_product
                }, function(data){
                  document.getElementById("change-content-product").innerHTML = data;
                })
                $.post('priceRounting.php', {
                        'id': id,
                        'id_product' : id_product
                }, function(data){
                  document.getElementById("change-price-result").innerHTML = data;
                })
}
function ChangePage(page){
  $.post('Page.php', {
                        'page': page
                }, function(data){
                  document.getElementById("page-address").innerHTML = data;
                })
}
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}
  function DeleteCartAcc(id){
    $.post('deleteCartAcc.php', {
                        'id': id 
                }, function(data){
                  document.getElementById("change-input-Ajax").innerHTML = data;
                })
                $.post('AddCart.php', {
                        'action' : 'UploadQuanlity'
                }, function(data){
                  document.getElementById("demo").innerHTML = data;
                })
          }
   function DeleteCart(id){
     console.log('xoa');
                $.post('deleteCart.php', {
                        'id': id 
                }, function(data){
                  document.getElementById("change-input-Ajax").innerHTML = data;
                })
                $.post('AddCart.php', {
                        'action' : 'UploadQuanlity'
                }, function(data){
                  document.getElementById("demo").innerHTML = data;
                })
          }
    function AjaxChange1(){
     // $('.cart-order').slideToggle(700);
     //Flex-full_Screen
     $('.Flex-full_Screen').slideToggle(100);
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
              $.post('AddCart.php', {
                        'action' : 'UploadQuanlity'
                }, function(data){
                  document.getElementById("demo").innerHTML = data;
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
function AddCart(id){
             
              $('.box-cart').fadeIn(300);
              $(function(){
                     var myFnc = function(){
                      $('.box-cart').fadeOut(300);
                   };
                  
                  setTimeout(myFnc, 3000);
                  
                 });
                $.post('AddCart.php', {
                        'id': id 
                }, function(data){
                  document.getElementById("Add-cart-change").innerHTML = data;
                })
                $.post('AddCart.php', {
                        'action' : 'UploadQuanlity'
                }, function(data){
                  document.getElementById("demo").innerHTML = data;
                })
          }
</script>
</body>
</html>