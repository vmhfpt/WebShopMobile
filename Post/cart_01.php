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
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  .Select-introduce img {
      margin-top :17px;
  }
  .Select-introduce {
    width : 220px;
    height : 350px ;
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
      //float : right !important;
      position : absolute;
      right : 55px;
      top : 3px ;
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
  
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <div class="float-right-cart">
  <?php
      if(isset($_SESSION['cart']['cart-id']) && count($_SESSION['cart']['cart-id']) > 0){
          echo '<div class="Number-oder">
          <span> '.count($_SESSION['cart']['cart-id']).' </span>
         </div>';
      }
    
    ?>
    <a href="cart.php"> <img src="https://laptopwin.com/wp-content/uploads/2018/02/icon-cart-03.png" width="46" height="46"> </a>
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
          echo '<div class="Number-oder">
          <span> '.count($_SESSION['cart']['cart-id']).' </span>
         </div>';
      }
    
    ?>
    <a href="cart.php"> <img src="https://laptopwin.com/wp-content/uploads/2018/02/icon-cart-03.png" width="46" height="46"> </a>
    </div>
  </div>  
</nav>
<div class="container" style="margin-top:30px">
    <div class="Float-left">
  Quảng Cáo bên trái
    </div>
    <div class="Float-right">
 Quảng cáo bên phải
    </div>
   
   <!-- <div style="margin-left : 4%" class="container"> -->
  <?php
  //(!isset($_SESSION['cart']) && !isset($_SESSION['order'])) || (isset($_SESSION['cart']) &&  count($_SESSION['cart']['cart-id']) == 0 && !isset($_SESSION['order'])) ||
  // if((!isset($_SESSION['cart']) && count($_SESSION['cart']['cart-id']) == 0) || () && !isset($_SESSION['order'])){
  if( (!isset($_SESSION['cart']) && !isset($_SESSION['order'])) || (isset($_SESSION['cart']) &&  count($_SESSION['cart']['cart-id']) == 0 && !isset($_SESSION['order'])) || (isset($_SESSION['order']) && $Test_Number_cart == 0)){
    echo ' <div class="add-buy-product">
    <center><h3>Chưa có sản phẩm nào trong giỏ hàng</h3></center> 
    <center><a href="index.php"><button type="button" class="btn btn-info">Tiếp Tục Mua Sắm</button></a></center> 
</div>';
  
  } else {
  ?>
  <form method="POST" action="cart.php?action=submit">
<table class="table table-bordered">
    <thead>
      <tr>
      <th>STT</th>
        <th>Tên Sản Phẩm</th>
        <th>Ảnh Sản Phẩm</th>
        <th>Đơn Giá</th>
        <th>Số lượng</th>
        <th>Thành Tiền</th>
        <th>Xóa</th>
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
      <?php  if (!isset($_SESSION['order'])){

        ?>
      <?php
       for ($i = 0; $i < count($cart); $i ++){
       //  echo $cart[$i]['name']. "<br/>";
       //echo $cart[$i]['id'] ."<br/>";
      ?>

<td><?=$i + 1?></td>
        <td><?=$cart[$i]['name']?></td>
        <td><img src="<?=$cart[$i]['image']?>" width="100" height="100"></td>
        <td style="color : red"> <b><?=number_format($cart[$i]['giamoi'], 0, ",", ".")?>đ </b></td>
       
        <td><center>  <div class="Sum-button">
     <button style="margin-right:3px" type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?=$cart[$i]['id']?>]"> - </button>
    <input  style="width : 55px !important;" type="text" name="quant[<?=$cart[$i]['id']?>]" class="form-control input-number" value="<?= $_SESSION['cart']['cart-number'][$cart[$i]['id']]?>" min="1" max="10"> 
     <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?=$cart[$i]['id']?>]">  +</button>
  </div></center></td>
        <td style="color:red"> <b><?=number_format($_SESSION['cart']['cart-number'][$cart[$i]['id']] * $cart[$i]['giamoi'], 0, ",", ".")?>đ </b> </td>
      
        <td><center><button onclick="DeleteCart(<?=$cart[$i]['id']?>)" type="button" class="btn btn-danger">Xóa</button></center></td>
      </tr>


     <?php }?>
     <?php }?>
     <?php
     if(isset($_SESSION['order'])){
      // foreach($result)
     // var_dump($result); 
   
    $SumNumber = 0;
      foreach($cart as $key){
        $count ++;
       // echo $key['id']. "<br/>";
      ?> 
<tr>
<td><?=$count?></td>
   <td><?=$key['name']?></td>
   <td><img src="<?=$key['image']?>" width="100" height="100"></td>
   <td style="color : red"> <b><?=number_format($key['giamoi'], 0, ",", ".")?>đ </b></td>
  
   <td><center>   <div class="Sum-button">
     <button style="margin-right:3px" type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[<?=$key['id']?>]"> - </button>
    <input  style="width : 55px !important;" type="text" name="quant[<?=$key['id']?>]" class="form-control input-number" value="<?php
    $change = Seacher($key['id']);
     $sql = 'SELECT * FROM order_accrount WHERE id = '. $change;
     $result_quantity = executeSingleResult($sql);
     echo $result_quantity['quantity'];
    
    ?>" min="1" max="10"> 
     <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?=$key['id']?>]">  +</button>
  </div></center></td>
  <?php  $SumNumber =  $SumNumber + ($key['giamoi'] * $result_quantity['quantity'])?>
   <td style="color:red"> <b><?=number_format($key['giamoi'] * $result_quantity['quantity'], 0, ",", ".")?>đ </b> </td>
 
   <!--<td><center><a href="deleteCartAcc.php?id=<?=$key['id'];?>"><button type="button" class="btn btn-danger">Xóa</button></a></center></td>-->
   <td><center><button onclick="DeleteCartAcc(<?=$key['id']?>)" type="button" class="btn btn-danger">Xóa</button></center></td>

</tr>
<?php  
}
 }
 //$SumNumber
   ?>
     
      <tr class="Sum-money">
        <td></td>
        <td>Tổng Tiền</td>
        <td></td>
        <td></td>
        <td></td>
        <td><?=number_format($SumNumber, 0, ",", ".")?>đ</td>
        <td></td>
      </tr>
    </tbody>
  </table>

 <button name="update-click" value="cập nhật" type="submit" class="btn btn-warning">Cập Nhật</button>
 <a href="index.php"><button type="button" class="btn btn-success">Tiếp Tục Mua Sắm</button></a>
 <!--</div> -->
 <div style="border-top : 1px solid #000000;
         width : 100%;
         margin-top : 40px;
         margin-bottom : 40px">
          
  </div>
  <?php 
    if(!isset($_SESSION['order'])){
  ?>
  <div class="form-group">
    <lable > Người nhận:</lable>
   <br/> <span> <?=$Error_name?></span>
      <input value = "<?=$name?>" autocomplete = "off" type="text" class="form-control" id="email" placeholder="Enter Your Name" name="name">
    </div>
    <div class="form-group">
    <lable > Điện thoại:</lable>
    <br/><span><?=$Error_phone?></span>
      <input value = "<?=$phone?>" autocomplete = "off" type="number" class="form-control" id="email" placeholder="Enter Number Phone" name="phone">
    </div>
    <div class="form-group">
    <lable > Điạ chỉ:</lable>
    <br/><span> <?=$Error_address?></span>
      <input value = "<?=$address?>" autocomplete = "off" type="text" class="form-control" id="email" placeholder="Enter Address" name="address">
    </div>
    <div class="form-group">
  <label for="comment">Ghi chú:</label>
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
      }?>
      
</div> 
<script type="text/javascript">
          function DeleteCart(id){
                $.post('deleteCart.php', {
                        'id': id 
                }, function(data){
                  location.reload() ;
                })
          }
          function DeleteCartAcc(id){
                $.post('deleteCartAcc.php', {
                        'id': id 
                }, function(data){
                  location.reload() ;
                })
          }
       </script>
<script type="text/javascript">
$( document ).ready(function() {
    $('.btn-number').click(function(e){
        e.preventDefault();
        
        var fieldName = $(this).attr('data-field');
        var type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                var minValue = parseInt(input.attr('min')); 
                if(!minValue) minValue = 1;
                if(currentVal > minValue) {
                    input.val(currentVal - 1).change();
                } 
                if(parseInt(input.val()) == minValue) {
                    $(this).attr('disabled', true);
                }
    
            } else if(type == 'plus') {
                var maxValue = parseInt(input.attr('max'));
                if(!maxValue) maxValue = 9999999999999;
                if(currentVal < maxValue) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == maxValue) {
                    $(this).attr('disabled', true);
                }
    
            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
       $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        
        var minValue =  parseInt($(this).attr('min'));
        var maxValue =  parseInt($(this).attr('max'));
        if(!minValue) minValue = 1;
        if(!maxValue) maxValue = 9999999999999;
        var valueCurrent = parseInt($(this).val());
        
        var name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        
        
    });
    $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                 // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
    });
});
</script>

</body>
</html>
