<?php
 ob_start();
 session_start();
 require_once ('./Help.php');
 
 if (!isset($_SESSION['order'])){
 $SumNumber = 0;
 $name = $address = $note = $phone = '';
 $Error_name = $Error_address = $Error_phone = '';
 if(isset($_POST['quant'])){
  $Number = $_POST['quant'];
  foreach($Number as $key => $value){
       $_SESSION['cart']['cart-number'][$key] = $value;
  }
 }
 if(isset($_SESSION['cart']) && count($_SESSION['cart']['cart-id']) != 0) {
  $SumNumber = 0;
  //echo count($_SESSION['cart']['cart-id']);
    $result_cart = $_SESSION['cart']['cart-id'];
    $Sum_array = count($result_cart) - 1;
    $char ='';
    foreach($result_cart as $key  => $value){
      //if($value == null) continue;
      $char = $char . $value ;
        $char = $char . ",";
      
    } 
    $char = substr($char, 0, -1);
    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')';
    $cart = executeResult($sql);
     if(isset($_POST['update-click'])){
     
    }
    for ($i = 0; $i < count($cart); $i ++){
      $SumNumber = $SumNumber + ($_SESSION['cart']['cart-number'][$cart[$i]['id']] * $cart[$i]['giamoi']);
     }
  }
  if (!empty($_GET)){
    if(isset($_GET['action'])){
      if(isset($_POST['update-click'])){
         
      }
      if(isset($_POST['oder-click'])){
       if(!empty($_POST)){
          if(isset($_POST['name'])){
            $name = $_POST['name'];
            if($name == ''){
              $Error_name ='* Tên không được để trống';
            }
          }
          if(isset($_POST['address'])){
            $address = $_POST['address'];
            if($address == ''){
              $Error_address = '* Địa chỉ không được để trống';
            }
            
          }
          if(isset($_POST['note'])){
            $note = $_POST['note'];
          }
          if(isset($_POST['phone'])){
            $phone = $_POST['phone'];
            if($phone == ''){
              $Error_phone = '* Địa chỉ không được để trống';
            }
          }
       }
     if($Error_name == '' && $Error_address == '' && $Error_phone == '' && isset($_POST)){
      function ReturnPrice($id){
                $sql = 'SELECT * FROM nokia WHERE id = '.$id;
                $result = executeSingleResult($sql);
                return ($result['giamoi']);
      }
         $create_time = date('d/m/Y - H:i:s');
         $update_time = date('d/m/Y - H:i:s');
   $sql_oder = 'INSERT INTO oder (name, phone, note, address, total, created_time, last_updated) VALUES ("'.$name.'", "'.$phone.'", "'.$note.'", "'.$address.'", "'.$SumNumber.'", "'. $update_time.'", "'.$create_time.'")';
   $oder_id =  execute($sql_oder);
   $product_id = $_SESSION['cart']['cart-id'];
     foreach ($product_id as $value){
        $quantity = $_SESSION['cart']['cart-number'][$value] ;
        $price = ReturnPrice($value);
       // var_dum($_SESSION['cart']['cart-number']); die();
        $sql_oder_detail = 'INSERT INTO oder_detail (order_id, product_id, quantity, price, created_time, last_updated) VALUES ("'.$oder_id.'", "'.$value.'", "'. $quantity.'", "'.$price.'", "'.date('d/m/Y - H:i:s').'", "'.date('d/m/Y - H:i:s').'")';
        execute($sql_oder_detail);
     }
        $_SESSION['alern'] = true;
        unset($_SESSION['cart']);
        header('location:index.php');
     
     $Test_order = true;
     } 
      }
    }

 }
}

 if (isset($_SESSION['order'])){
  function Seacher($id_product){
    $sql = 'SELECT * FROM `order_accrount` WHERE `id_accrount` = '.$_SESSION['order']['id'].'';
    $result = executeResult($sql);
   // echo count($result); die();
    foreach ( $result as $key => $value){
      if($value['id_product'] == $id_product){
          return($value['id']);
      }
    }
  }
  function UpdateQuantity($id_product, $quantity){
    $sql = 'SELECT * FROM `order_accrount` WHERE `id_accrount` = '.$_SESSION['order']['id'].'';
    $result = executeResult($sql);
    foreach ($result as $key => $value){
          if($value['id_product'] == $id_product){
             $id_change_quantity = $value['id'];
            $change = 'UPDATE order_accrount SET quantity = "'.$quantity.'" WHERE id = '.$value['id'] ;
            execute($change);
            return(0);
            // echo "id thay đổi : ".$id_change_quantity. "<br/>";
          }
    }
  }
  if(isset($_POST['quant'])){
    $Number = $_POST['quant'];
    foreach($Number as $key => $value){
        // var_dump($value);
       // echo $key."--";
       // echo $value;
        UpdateQuantity($key, $value);
    }
   }
  // echo 'giỏ hàng sử dụng tài khoản'; die();
    //var_dump($_SESSION['order']);die();
    $id_accrount = $_SESSION['order']['id'];
    $sql = 'SELECT * FROM `order_accrount` WHERE `id_accrount` = '.$id_accrount.'';
    $result = executeResult($sql);
    $Test_Number_cart = count($result);
    if( $Test_Number_cart != 0){
    $char = '';
    foreach($result as $key => $value){
      // echo $value['id_product']. "<br/>";
       $char = $char . $value['id_product'] . ",";
    }
    $char = substr($char, 0, -1);
    //echo $char;
    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')';
    $cart = executeResult($sql);
    $count = 0;
  }
}

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
    height : 400px ;
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
  .Float-left {
    background-color: #929292;
     position: absolute;
     margin-left : 2% ;
     top : 70px;
     left : 0px;
     width : 15% ;
     height: 1280px ;
  }
  .Float-right{
    background-color: #3be407;
    position: absolute;
     top : 70px;
     margin-right : 2%;
     right : 0px;
     width : 15% ;
     height: 1280px ;
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
 width: 50%;

 border-radius : 5px;
}
.product-result-seacher {
  border-bottom: 1px dotted #000000;
  width:100%;
  height : 80px;
}
.Click-Submit {
  display : flex;
    justify-content : center;
  
  padding-top : 30px;
   background: wheat;
   position: fixed;
   width : 960px;
   
   border-radius : 12px;
}
.badge {
  background-color: red;
  color : white;
}
.Click-Submit h3 {
  text-align: center !important;
  font-size : 20px;
}
.btn-float {
    float : right ;
     position: absolute;
     top : 0px;
     right : 0px ;
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
      // cộng hòa xã hội chủ nghĩa Việt Nam
      // độc lập tự do hạnh phúc 
      // Đơn xin nghỉ việc
      // Tên 
      
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

<div id="suscess" style="display : none;">
<div class="Click-Submit">
  <div  id="change-alert" style="border: 1px solid #000000;width : 500px; padding : 22px ">

</div>
</div>
  </div>
    
  
    <div style="margin-left : 4%" class="container">
  
<div class="container" style="margin-top:30px">
<table id="change-input-Ajax" class="table table-bordered">
    <thead>
      <tr>
      <th>STT</th>
        <th>Tên Sản Phẩm</th>
        <th>Ảnh Sản Phẩm</th>
        <th>Đơn Giá</th>
        <th>Số lượng</th>
        <th>Thành Tiền</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
     <!-- <td>1</td>
        <td>Iphone</td>
        <td><img src="" width="100" height="140"></td>
        <td>200000đ</td>
        <td><center>  <div class="Sum-button">
     <button style="margin-right:3px" type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]"> - </button>
    <input  style="width : 55px !important;" type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="10"> 
     <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">  +</button>
  </div></center></td>
        <td>.......</td>
        <td><center><button type="button" class="btn btn-danger">Xóa</button></center></td>
      </tr> -->

      <?php
       for ($i = 0; $i < count($cart); $i ++){
      ?>

<td><?=$i + 1?></td>
        <td><?=$cart[$i]['name']?></td>
        <td><img src="<?=$cart[$i]['image']?>" width="100" height="100"></td>
        <td style="color : red"> <b><?=number_format($cart[$i]['giamoi'], 0, ",", ".")?>đ </b></td>
       
        <td><center>  <div class="Sum-button">
   
      


       
       
        
        <?php  if (!isset($_SESSION['order'])){?>


      <?=$_SESSION['cart']['cart-number'][$cart[$i]['id']]?>

        <?php } else {?>

         

        <?php }?>
   
    
    
 
     
  </div></center></td>
  <?php  if (!isset($_SESSION['order'])){?>
        <td style="color:red"> <b><?=number_format($_SESSION['cart']['cart-number'][$cart[$i]['id']] * $cart[$i]['giamoi'], 0, ",", ".")?>đ </b> </td>
        <?php } else {?>
          <td style="color:red"> <b><?=number_format($cart[$i]['giamoi'] * $result_quantity['quantity'], 0, ",", ".")?>đ </b> </td>
       
          <?php  $SumNumber =  $SumNumber + ($cart[$i]['giamoi'] * $result_quantity['quantity']); }?>
  
      </tr>


     <?php }?>

      <tr class="Sum-money">
        <td></td>
        <td>Tổng Tiền</td>
        <td></td>
        <td></td>
        <td></td>
        <td><?=number_format($SumNumber, 0, ",", ".")?>đ</td>
      
      </tr>
    </tbody>
  </table>
  <div style="border-top : 1px solid #000000;
         width : 100%;
         margin-top : 40px;
         margin-bottom : 40px">
          
  </div>
  <?php 
    if(!isset($_SESSION['order'])){
  ?>
  <form name="checkForm" action="" method="POST" onsubmit="return validateForm(<?=$SumNumber?>)" >
 
  <div class="form-group">
    <lable > Người nhận:</lable>
   <br/> <span id="error-name"> * Bắt buộc nhập</span>
      <input value = "<?=$name?>" autocomplete = "off" type="text" class="form-control"  placeholder="Enter Your Name" name="name">
    </div>
    <div class="form-group">
    <lable > Điện thoại:</lable>
    <br/><span id="error-phone"> * Bắt buộc nhập</span>
      <input value = "<?=$phone?>" autocomplete = "off" type="number" class="form-control"  placeholder="Enter Number Phone" name="phone">
    </div>
    <div class="form-group"> 
    <lable > Điạ chỉ:</lable>
    <br/><span id="error-address"> * Bắt buộc nhập</span>
      <input value = "<?=$address?>" autocomplete = "off" type="text" class="form-control"  placeholder="Enter Address" name="address">
    </div>
    <div class="form-group">
  <label for="comment">Ghi chú:</label>
  <br/><span> * Không bắt buộc</span>
  <textarea  class="form-control" rows="5" id="comment" name="note"><?=$note?></textarea>
</div>
   <?php } ?>
   <?php
   if(isset($_POST['oder-click']) && isset($_SESSION['order'])){
       if(!empty($_POST)){  
          if(isset($_POST['note'])){
            $note = $_POST['note'];
          }
       }
       //  string(179) "INSERT INTO oder_detail (order_id, product_id, quantity, price, created_time, last_updated) VALUES ("74", "302", "1", "12034000", "20/02/2021 - 15:56:34", "20/02/2021 - 15:56:34")"

     //  echo $note;
      // echo $SumNumber;
      // var_dump($_SESSION['order']);
      function ReturnPrice($id){
                $sql = 'SELECT * FROM nokia WHERE id = '.$id;
                $result = executeSingleResult($sql);
                return ($result['giamoi']);
      }
         $create_time = date('d/m/Y - H:i:s');
         $update_time = date('d/m/Y - H:i:s');
   $sql_oder = 'INSERT INTO oder (name, phone, note, address, total, created_time, last_updated) VALUES ("'.$_SESSION['order']['username'].'", "'.$_SESSION['order']['NumberPhone'].'", "'.$note.'", "'.$_SESSION['order']['address'].'", "'.$SumNumber.'", "'. $update_time.'", "'.$create_time.'")';
   //$oder_id =  execute($sql_oder);
   $oder_id =  execute($sql_oder);
    
   $product_id =  'SELECT * FROM `order_accrount` WHERE `id_accrount` = '.$_SESSION['order']['id'].'';
   $result_acc = executeResult($product_id);
     foreach ($result_acc as $key => $value){
     
     
        $price = ReturnPrice($value['id_product']);
        $sql_oder_detail = 'INSERT INTO oder_detail (order_id, product_id, quantity, price, created_time, last_updated) VALUES ("'.$oder_id.'", "'.$value['id_product'].'", "'.$value['quantity'].'", "'.$price.'", "'.date('d/m/Y - H:i:s').'", "'.date('d/m/Y - H:i:s').'")';
      //  var_dump($sql_oder_detail);
        execute($sql_oder_detail);
     } 
     $sql = 'DELETE FROM `order_accrount` WHERE `id_accrount` = '.$_SESSION['order']['id'].'';
     execute($sql);
     $_SESSION['alern'] = true;
     header('location:index.php');
     $Test_order = true;
    
      }
      ?>
      <?php if(isset($_SESSION['order'])) {
        ?>
       <div class="form-group">
  <label for="comment">Ghi chú:</label>
  <textarea  class="form-control" rows="5" id="comment" name="note"></textarea>
</div>
<?php } ?>
    <button style="margin-bottom : 50px" name="oder-click" value="đặt hàng" type="submit" class="btn btn-primary">Đặt hàng</button>
    </form>

      <?php 
      ob_end_flush();
      ?>
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
function CloseTab(){
  
        $('#suscess').toggle(200);


}
function validateForm(total) {
  var name = document.forms["checkForm"]["name"].value;
  var phone = document.forms["checkForm"]["phone"].value;
  var address = document.forms["checkForm"]["address"].value;
  var notice = document.forms["checkForm"]["note"].value;
  //name phone address
  //console.log(name);
 // console.log(phone);
 // console.log(address);
  //console.log(total);
 // console.log(notice);
 errorName = '';
  errorAddress = '';
  errorPhone = '';
  if(name ==''){
    errorName = '* Tên không được để trống';
  }
  if(phone ==''){
    errorPhone = '* Điện thoại không được để trống';
  }
  if(address ==''){
    errorAddress = '* Địa chỉ không được để trống';
  }
  if((errorName != '') || (errorAddress != '') || (errorPhone != '')){
    document.getElementById('error-name').innerHTML =  errorName;
    document.getElementById('error-phone').innerHTML =  errorPhone;
    document.getElementById('error-address').innerHTML =  errorAddress;
     return (false);
  }
  $('#suscess').slideToggle(100);
  //var x = document.forms["myForm"]["fname"].value;
 // if (x == "") {
   // alert("Name must be filled out");
   SuscessAddCart(name, address, phone, notice, total, 0);
    return false;
 // }
}
function SuscessAddCart(name, address, number, notice, total, action){
  console.log(action);
     $.post('SuscessCart.php', {
           'name' : name,
           'address' : address,
           'NumberPhone' : number,
           'notice' : notice,
           'action' : action,
           'total' : total
     }, function(data) {
  // document.getElenmentById("change-alert").innerHTML = data;
  if(action != 1){
   document.getElementById("change-alert").innerHTML = data;
  }else {
    location.replace("index.php");
  }
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