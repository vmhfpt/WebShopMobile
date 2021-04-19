<?php 
 define ('localhost', 'localhost');
 define ('username', 'root');
 define ('password', '');
 define ('NameDatabase', 'banhang');
 $conn = mysqli_connect(localhost, username, password, NameDatabase);
 if (mysqli_connect_error($conn)){
     echo 'Kết nối không thành công';
     die();
 }
if (isset($_POST['url'])){
    $url = $_POST['url'] ;
    $sql = "DELETE FROM  `image_library` WHERE  `path` = '{$url}'" ;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
   unlink($url);
    echo 'Xóa thành công';
    }
if (isset($_POST['id'])){
    if (isset($_POST['url1'])){
        $url1 = $_POST['url1'] ;
       if($url1[0] == '.'){
           unlink($url1);
       }
    }
    $id = $_POST['id'] ;
    $sql_full_file = "SELECT * FROM  `image_library` WHERE  `product_id` = '{$id}'" ;
   $result_full_file = mysqli_query($conn, $sql_full_file);
   $data = [];
   while ($row = mysqli_fetch_array($result_full_file, 1)){
       $data[] = $row;
   }
   foreach ($data as $key){
       unlink($key['path']) ;
   }
    $select = 'SELECT * FROM nokia WHERE id = '.$id ;
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result, 1);
    $name = $row['name'];
    $sql = 'DELETE FROM nokia WHERE id = '.$id ;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "Xóa Sản Phẩm  $name thành công" ;
    }
   