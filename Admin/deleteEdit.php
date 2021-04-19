<?php
 require_once ('./Help.php');
 if(!empty($_POST)){
     if(isset($_POST['id'])){
      foreach($_POST['id'] as $key){
         // echo $key. "<br/>";
          //DELETE FROM `products_bought` WHERE `products_bought`.`id` = 28
          if($_POST['type'] == 1){
           $sql = "DELETE FROM `products_bought` WHERE `products_bought`.`id_product` = $key";
          // var_dump($sql);
          execute($sql);
          }else {
            $sql = "DELETE FROM `selling_products` WHERE `selling_products`.`id_product` = $key";
            // var_dump($sql);
            execute($sql);
          }
      }

     }
 }



?>