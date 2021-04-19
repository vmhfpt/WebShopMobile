<?php
define ('localhost', 'localhost');
define ('username', 'root');
define ('password', '');
define ('NameDatabase', 'banhang');
function ReturnDataComment($data_comment, $id_parent, $lever){
    $result_comment =  array();
    foreach($data_comment as $key => $value){
        if($id_parent == $value['id_parent']){
            $value['lever'] = $lever;
            $result_comment[] =  $value;
            unset($data_comment[$key]);
            $children = ReturnDataComment($data_comment, $value['id'], $lever + 1);
            $result_comment = array_merge($result_comment,  $children);
        }
    }
   return($result_comment);
}

function ReturnSumCount($data_comment, $parent_id){
   $count = 0;
     foreach($data_comment as $key => $value){
         if ($value['id_parent'] == $parent_id){
             $count ++;
         }
     }
     return($count);
}
  function LastID(){
    $conn = mysqli_connect(localhost, username, password, NameDatabase);
    return($conn->insert_id);
  }
   function execute($sql){
    $conn = mysqli_connect(localhost, username, password, NameDatabase);
    if (mysqli_connect_error($conn) == true){
        echo 'connection false complete';
        die();
    }
    $result = mysqli_query($conn, $sql);
    return ($conn->insert_id);
    mysqli_close($conn);
    
}
   function executeResult($sql){
        $conn = mysqli_connect(localhost, username, password, NameDatabase);
        if (mysqli_connect_error($conn) == true){
            echo 'connection false complete';
            die();
        }
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $data = [];
        while ($row = mysqli_fetch_array($result, 1)){
            $data[] = $row;
        }
        return ($data);
   }
   function executeSingleResult($sql){
       $conn = mysqli_connect(localhost, username, password, NameDatabase);
       if (mysqli_connect_error($conn) == true){
        echo 'connection false complete';
        die();
    }
     $result = mysqli_query($conn, $sql);
     mysqli_close($conn);
     $row = mysqli_fetch_array($result, 1);
     return ($row);
   }