<?php
session_start();
  if(isset($_SESSION['cart'])){
    //  var_dump($_SESSION['cart']['cart-number']);
    foreach($_SESSION['cart']['cart-number'] as $key){
        echo $key . "<br/>";
    }
  }



?>