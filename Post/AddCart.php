<?php
 session_start();
 require_once ('./Help.php');
 function Boolen($id){
      for ($i = 0;$i < count( $_SESSION['cart']['cart-number']); $i ++){
          if (isset($_SESSION['cart']['cart-id'][$i]) && $_SESSION['cart']['cart-id'][$i] == $id){
            $_SESSION['cart']['cart-number'][$id] =  $_SESSION['cart']['cart-number'][$id]  + 1;
              return (false); 
          }
      }
      return (true);
 }
 function Boolened($id){
    $sql = 'SELECT * FROM `order_accrount` WHERE `id_accrount` = '.$_SESSION['order']['id'].'';
    $result = executeResult($sql);
    foreach($result as $key => $value){
           if($id == $value['id_product']){
               return (false);
           }
      }
      return(true);
 }
 if(!isset( $_SESSION['order'])){
    if(!empty($_POST)){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            //echo $id ;
            if (!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
                $_SESSION['cart']['cart-id'][0] =  $id;
                $_SESSION['cart']['cart-number'][$id] =  1;
               //$_SESSION['cart'][0] =  $id;
              // $_SESSION['cart']['cart-number'][0] =  1;
            }else {
                if(Boolen($id) == true){
                   $_SESSION['cart']['cart-id'][] =  $id;
                   $_SESSION['cart']['cart-number'][$id] =  1;
                }
              //  $_SESSION['cart'][] =  $id;
               // $_SESSION['cart']['cart-number'][] =  1;
            }
         //   echo ' <span> '.count($_SESSION['cart']['cart-id']).' </span>';
        }

    }
} else if(isset($_SESSION['order'])){
    if(!empty($_POST)){
        if(isset($_POST['id'])){
           $id = $_POST['id'];
           $id_accrount = $_SESSION['order']['id'];
           $id_product =  $id;
           $quantity = 1;
           if (Boolened($id) == true){
             $sql = 'INSERT INTO order_accrount (id_accrount, id_product, quantity) VALUES ("'.$id_accrount.'", "'.$id_product.'", "'.$quantity.'")';
           }
           execute($sql);
        }
    }
  //echo ' <span> '.count($_SESSION['cart']['cart-id']).' </span>';
}
if (!isset($_POST['action'])){
 $sql = 'SELECT * FROM nokia WHERE id = '.$id ;
 $result = executeSingleResult($sql);
 echo '  <div class="box-content-cart">
 <img  src="'.$result['image'].'" width="140" height="150">
 <div style="float: left ;
  margin:20px 0px 0px 12px;">
 <h4> '.$result['name'].'</h4>
 <h6 style="color : red"> '.number_format($result['giamoi'], 0, ",", ".").' đ</h6>
 </div>
</div>';
}else {
  if(isset($_SESSION['cart'])){
    $SumQuanlity = 0;
    //  var_dump($_SESSION['cart']['cart-number']);
    foreach($_SESSION['cart']['cart-number'] as $key){
 $SumQuanlity = $SumQuanlity + $key;
    }
    echo '<span> '.$SumQuanlity.'</span>' ;
  }
}
?>