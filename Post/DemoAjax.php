<?php
session_start();
 if(!empty($_POST)){
    if($_POST['id'] > 0 && $_POST['id'] <= 10 && isset($_POST['id'])){
     if (isset($_POST['id'])){
        $Quanlity = $_POST['id'];
      //  echo " Số Lượng : ". $_POST['id']. "<br/>";
     }
     if (isset($_POST['product'])){
      //  echo "Id sản phẩm : ".$_POST['product']. "<br/>";
        $Id_product = $_POST['product'];
    }
    if (!isset($_SESSION['order'])){
         $_SESSION['cart']['cart-number'][$Id_product] =  $Quanlity;
    }
}
 }
 require_once ('./Help.php');
 if (!isset($_SESSION['order'])){
  if(isset($_SESSION['cart']) && count($_SESSION['cart']['cart-id']) != 0) {
    $SumNumber = 0;
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
 } else {
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
  if(!empty($_POST) && $_POST['id'] > 0 && $_POST['id'] <= 10 && isset($_POST['id'])){
  UpdateQuantity( $Id_product, $Quanlity);
  }
  $SumNumber = 0;
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
  
 // var_dump($cart); die();
}
 }
?>
<?php    if( (!isset($_SESSION['cart']) && !isset($_SESSION['order'])) || (isset($_SESSION['cart']) &&  count($_SESSION['cart']['cart-id']) == 0 && !isset($_SESSION['order'])) || (isset($_SESSION['order']) && $Test_Number_cart == 0)){
    echo ' <div class="add-buy-product">
    <center><h3>Chưa có sản phẩm nào trong giỏ hàng</h3></center> 
    <center><a href="index.php"><button type="button" class="btn btn-info">Tiếp Tục Mua Sắm</button></a></center> 
</div>';
  
  } else {?>
          
<table id="change-input-Ajax" class="table table-bordered">
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

      <?php
       for ($i = 0; $i < count($cart); $i ++){
      ?>

<td><?=$i + 1?></td>
        <td><?=$cart[$i]['name']?></td>
        <td><img src="<?=$cart[$i]['image']?>" width="100" height="100"></td>
        <td style="color : red"> <b><?=number_format($cart[$i]['giamoi'], 0, ",", ".")?>đ </b></td>
       
        <td><center>  <div class="Sum-button">
   
      


       
       
        <button onclick="press($(this).attr('data-field'), $(this).attr('data-type'), $(this).attr('name'))" name="<?=$cart[$i]['id']?>" style="margin-right:3px" type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[<?=$cart[$i]['id']?>]"> - </button>
        <?php  if (!isset($_SESSION['order'])){?>


          <input onchange="ChangeInput(parseInt($(this).attr('min')), parseInt($(this).attr('max')), $(this).attr('name'), $(this).attr('id'), parseInt($(this).val()))" id="<?=$cart[$i]['id']?>" style="width : 55px !important;" type="text" name="quant[<?=$cart[$i]['id']?>]" class="form-control input-number" value="<?=$_SESSION['cart']['cart-number'][$cart[$i]['id']]?>" min="1" max="10"> 

        <?php } else {?>

          <input onchange="ChangeInput(parseInt($(this).attr('min')), parseInt($(this).attr('max')), $(this).attr('name'), $(this).attr('id'), parseInt($(this).val()))" id="<?=$cart[$i]['id']?>" style="width : 55px !important;" type="text" name="quant[<?=$cart[$i]['id']?>]" class="form-control input-number" value="<?php
    $change = Seacher($cart[$i]['id']);
     $sql = 'SELECT * FROM order_accrount WHERE id = '. $change;
     $result_quantity = executeSingleResult($sql);
     echo $result_quantity['quantity'];
    
    ?>" min="1" max="10"> 

        <?php }?>
   
    
     <button onclick="next($(this).attr('data-field'), $(this).attr('data-type'), $(this).attr('name'))" name="<?=$cart[$i]['id']?>"  type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?=$cart[$i]['id']?>]">  +</button>
 
     
  </div></center></td>
  <?php  if (!isset($_SESSION['order'])){?>
        <td style="color:red"> <b><?=number_format($_SESSION['cart']['cart-number'][$cart[$i]['id']] * $cart[$i]['giamoi'], 0, ",", ".")?>đ </b> </td>
        <?php } else {?>
          <td style="color:red"> <b><?=number_format($cart[$i]['giamoi'] * $result_quantity['quantity'], 0, ",", ".")?>đ </b> </td>
       
          <?php  $SumNumber =  $SumNumber + ($cart[$i]['giamoi'] * $result_quantity['quantity']); }?>
          <?php if (!isset($_SESSION['order'])){?>
        <td><center><button onclick="DeleteCart(<?=$cart[$i]['id']?>)" type="button" class="btn btn-danger">Xóa</button></center></td>
        <?php } else {?>
        <td><center><button onclick="DeleteCartAcc(<?=$cart[$i]['id']?>)" type="button" class="btn btn-danger">Xóa</button></center></td>
        <?php }?>
      </tr>


     <?php }?>

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
 
  <?php } ?>
  <div style="margin-top : 30px">
 <center><a href="cart.php"> <button  type="button" class="btn btn-warning">Chuyển đến thanh toán</button></a></center> 
  </div>