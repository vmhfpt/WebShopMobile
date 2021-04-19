<?php
 require_once ('./Help.php') ;
 function FunctionDeleteChildren($Listmenu, $parent_id){
     //echo 'Chạy vào đây';
    // echo $parent_id. "<br/>";
    foreach($Listmenu as $key => $value){
        //echo $value['id']. "<br/>";
        if($parent_id == $value['parent_id']){
           // echo $parent_id. "<br/>";
            //echo 'Xóa danh mục với ID cha : '.$parent_id.' <br/>';
            FunctionDeleteChildren($Listmenu, $value['id']);
        //   $sql = 'DELETE menu WHERE id = '.$value['id'];
           $sql =  "DELETE FROM `menu` WHERE `menu`.`id` = ".$value['id']."";
           execute($sql);
          // var_dump($sql);
           
        }
    }
} 
function returnNameDelete($id){
      $sql = 'SELECT * FROM menu WHERE id = '.$id;
      $result = executeResult($sql);
     // var_dump(  $result);
      return ($result[0]['name']);
}
 if(!empty($_POST)){
     if(isset($_POST['id'])){
         $id = $_POST['id'];
         $Name_delete = returnNameDelete($id);
        // echo $Name_delete ;die();
 $sql = 'SELECT * FROM menu';
 $result = executeResult($sql);
         FunctionDeleteChildren($result, $id);
         $sql =  "DELETE FROM `menu` WHERE `menu`.`id` = ".$id."";
       //  var_dump($sql);
        execute($sql);
         echo "Xóa Danh mục '" .$Name_delete. "' thành công";
     }
 }

?>