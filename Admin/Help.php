<?php
define ('localhost', 'localhost');
define ('username', 'root');
define ('password', '');
define ('NameDatabase', 'banhang');
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