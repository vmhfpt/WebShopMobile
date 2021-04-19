<?php
 session_start();
 require_once ('./Help.php');
if(!empty($_POST)){
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }
    if(isset($_POST['address'])){
        $address = $_POST['address'];
    }
    if(isset($_POST['NumberPhone'])){
        $numberPhone = $_POST['NumberPhone'];
    }
    if(isset($_POST['notice'])){
        $notice = $_POST['notice'];
    }
    if(isset($_POST['total'])){
        $total = $_POST['total'];
    }

}



?>
<?php if(isset($_POST['action']) && $_POST['action'] == 0){?>
<button style="border-radius:30px;" onclick="CloseTab()" type="button" class="btn-float btn btn-danger"> X </button>
<div class="alert alert-success">
    <strong>Họ Và Tên : </strong> <?=$name?>
  </div>
  <div class="alert alert-success">
    <strong>Số Điện Thoại : </strong>  <?=$numberPhone?>
  </div>
  <div class="alert alert-success">
    <strong>Địa Chỉ : </strong> <?=$address?>
  </div>
  <div class="alert alert-success">
    <strong>Tổng Tiền : </strong> <?=number_format($total, 0, ",", ".")?>đ
  </div>
  <div class="alert alert-success">
    <strong>Ghi Chú : </strong> <?= $notice?>
  </div>
<center><button onclick="SuscessAddCart('<?=$name?>',' <?=$address?>', <?=$numberPhone?>, '<?= $notice?>',<?= $total?>,  1)" style="margin-top : 30px;" type="button" class="btn btn-warning">Xác Nhận</button> </center>
<?php } else {
  // sử lí hóa đơn cập nhật thông tin đặt hàng của người dùng ở đây
  // pay in comple userused information  in come here
 // unset($_SESSION['cart']);
 // echo 'chuyển hướng sang xác nhận thông tin người dùng';
 
    function ReturnPrice($id){
      $sql = 'SELECT * FROM nokia WHERE id = '.$id;
      $result = executeSingleResult($sql);
      return ($result['giamoi']);
}
$create_time = date('d/m/Y - H:i:s');
$update_time = date('d/m/Y - H:i:s');
$sql_oder = 'INSERT INTO oder (name, phone, note, address, total, created_time, last_updated) VALUES ("'.$name.'", "'.$numberPhone.'", "'.$notice.'", "'.$address.'", "'.$total.'", "'. $update_time.'", "'.$create_time.'")';
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
    
}
   
    
    ?>