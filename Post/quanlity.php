<?php
session_start();
require_once ('./Help.php');
if (isset($_POST['id'])){
    $id = $_POST['id'] ;
//  echo $id . "<br/>";
}
if (isset($_POST['id_product'])){
  $id_product = $_POST['id_product'] ;
// echo $id_product;
}

if(isset($_SESSION['cart']['cart-number'])){
     $_SESSION['cart']['cart-number'][$id_product] = $id;
  // echo 'Tồn tại phiên giỏ hàng';
  //var_dump($_SESSION['cart']);
   //var_dump($_SESSION['cart']);
}
 
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
 
?>
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
       //  echo $cart[$i]['name']. "<br/>";
       //echo $cart[$i]['id'] ."<br/>";
      ?>

<td><?=$i + 1?></td>
        <td><?=$cart[$i]['name']?></td>
        <td><img src="<?=$cart[$i]['image']?>" width="100" height="100"></td>
        <td style="color : red"> <b><?=number_format($cart[$i]['giamoi'], 0, ",", ".")?>đ </b></td>
       
        <td><center>  <div class="Sum-button">
     <button  style="margin-right:3px" type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?=$cart[$i]['id']?>]"> - </button>
    <input  style="width : 55px !important;" type="text" name="quant[<?=$cart[$i]['id']?>]" class="form-control input-number" value="<?= $_SESSION['cart']['cart-number'][$cart[$i]['id']]?>" min="1" max="10"> 
     <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?=$cart[$i]['id']?>]">  +</button>
  </div></center></td>
        <td style="color:red"> <b><?=number_format($_SESSION['cart']['cart-number'][$cart[$i]['id']] * $cart[$i]['giamoi'], 0, ",", ".")?>đ </b> </td>
      
        <td><center><button onclick="DeleteCart(<?=$cart[$i]['id']?>)" type="button" class="btn btn-danger">Xóa</button></center></td>
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