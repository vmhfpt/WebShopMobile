<?php
 
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./Help.php') ;
  require_once ('./function.php') ;
  $Name_admin = $_SESSION['login']['printf_name'];
  $char_error_name_parent_id = $char_error_name = $char_error_giacu = $char_error_giamoi = $char_error_content = '';
  $name_parent_id = $Error_file_image = $name = $image = $giamoi = $giacu = $content = '';
   $Value_image = true ;
   $Copy = false;
   $sql = "SELECT * FROM menu";
   $result = executeResult($sql) ;
   $menuTree = createMenuTree($result, 0, 0);
   if(isset($_GET['takes'])){
       $Copy = true ;
}
    $UploadFile_Errors = false;
    $Test_image = false;
   if (isset($_FILES['file_image'])){
     $uploadedFile = $_FILES['file_image'];
    if($uploadedFile['name'][0] == ''){
        $Value_image = false;
    }
  }
  if (!empty($_GET)){
    if (isset($_GET['id'])){
         $id = $_GET['id']; 
             $sql = 'SELECT * FROM nokia WHERE id = '. $id;
             $result = executeResult($sql);
             $name = $result[0]['name'];
             $image = $result[0]['image'];
             $Temp_image = $image;
             $giamoi = $result[0]['giamoi'];
             $giacu = $result[0]['giacu'];
             $content = $result[0]['content'];
             $name_parent_id = $result[0]['category'];
      }
   }
     if(!empty($_POST)){
          if(isset($_POST['name'])){
             $name = $_POST['name'];
             if($name == ''){
                $char_error_name = '* Tên sản phẩm không được để trống';
             }
          }
          if(isset($_POST['image'])){
             $image = $_POST['image'];
             
          }
          if(isset($_POST['giamoi'])){
             $giamoi = $_POST['giamoi'];
             if($giamoi == ''){
              $char_error_giamoi = '* Giá mới không được để trống';
             }
          }
          if(isset($_POST['giacu'])){
            $giacu = $_POST['giacu'];
            if($giacu == ''){
              $char_error_giacu = '* Giá cũ không được để trống';
             }
         } 
         if(isset($_POST['lol'])){
            $content = $_POST['lol'];
            $content = str_replace('"', '\\"', $content) ;
            if ($content == ''){
              $char_error_content = '* Nội dung không được để trống';
            }
         }
         if(isset($_POST['name_parent_id'])){
          $name_parent_id = $_POST['name_parent_id'];
          if ($name_parent_id == 0){
            $char_error_name_parent_id = '* Danh mục không được để trống';
          }
         
          }
        
     }
     if ($image == '' && $Value_image == false){
      $Error_file_image = '* Bạn chưa chọn ảnh nào';
     } 
     if ($image != '' && $Value_image == true){
      $Error_file_image = '* Chỉ lựa chọn 1 cách tải ảnh lên';
     }
     if($name != '' && $giamoi != '' && $giacu != '' && $content != '' && $name_parent_id != 0){
          if ($image != '' && $Error_file_image == ''){
             //   echo 'upload qua link <br/>';
                //echo 'upload anh thanh cong voi ten file : '.$image.' ' ;
          } else if($Error_file_image == ''){
             // echo 'upload anh qua thiet bi<br/>';
               if (isset($_FILES['file_image'])){
                $uploadedFile = $_FILES['file_image'];
                $errors = uploadFiles($uploadedFile);
                $char_name = $errors[0];
                if($char_name[0] != '.'){
                    $Error_file_image = $errors[0];
                } else {
               //   echo 'upload anh thanh cong voi ten file : '.$errors[0].' ' ;
                  $image = $errors[0];
                }
           }
          }
          if($Error_file_image == ''){
           //     echo '<br/>Cho upload thu vien anh<br/>';
                if (isset($_FILES['full_file_image']) && $_FILES['full_file_image']['name'][0] != ''){
                       $full_file_image = $_FILES['full_file_image'];
                     $Files = array();
                     $Errors = array();
                     $Errors = upLoadFiles($full_file_image);
                     for($i = 0; $i < count($Errors); $i ++){
                         if($Errors[$i] == 1) {
                            $UploadFile_Errors = true;
                             for( $j = 0; $j < count($Errors); $j ++){
                              if($Errors[$j] == 1) continue;
                              $char_temp_name = $Errors[$j];
                                if($char_temp_name[0] == '.'){
                                   unlink($Errors[$j]);
                                }
                             }
                             break;
                         }
                     }
                     if($UploadFile_Errors == true){
                    //  echo 'Upload Thư Viện Ảnh Có Lỗi<br/>';
                      for($i = 0; $i < count($Errors); $i ++){
                        if ($Errors[$i] == 1) continue;
                        $char_name = $Errors[$i];
                        if($char_name[0] != '.'){
                            echo $Errors[$i]. "<br/>";
                        }
                     }
                  } else  {
                   //  echo 'Upload Thư Viện Ảnh Thành Công<br/>';
                     $Test_image = true;
                     for($i = 0; $i < count($Errors); $i ++){
                     //  echo $Errors[$i]. "<br/>";
                     }
                     
                  }
                 }
              if($UploadFile_Errors == false){
                  if(!isset($_GET['id']) || $Copy == true){
                     $sql = 'INSERT INTO nokia (name, image, giacu, giamoi, content, category) VALUES ("'.$name.'", "'.$image.'", "'.$giacu.'", "'.$giamoi.'", "'.$content.'", "'.$name_parent_id.'")' ;
                    $id_vote = execute($sql) ;


                     $sqlVote = "INSERT INTO `voteproduct` (`id`, `id_product`, `QuanlityStar1`, `QuanlityStar2`, `QuanlityStar3`, `QuanlityStar4`, `QuanlityStar5`) VALUES (NULL, ".$id_vote.", '0', '0', '0', '0', '0')" ;
                     
                   //  var_dump($sqlVote); die();
                    execute($sqlVote);

                  } else if($Copy == false){
                       $sql = 'UPDATE nokia SET name = "'.$name.'", content = "'.$content.'", category = "'.$name_parent_id.'", image = "'.$image.'", giacu = "'. $giacu.'", giamoi = "'.$giamoi.'" WHERE id = '.$id ;
                       execute($sql) ;
                       if($Temp_image[0] == '.'){
                        unlink($Temp_image);
                     }
                  }
                  if( $Test_image == true){
                    if (!isset($_GET['id'])){
                       $sql = 'SELECT * FROM nokia';
                      $result = executeResult($sql) ;
                      $count_id = count($result) - 1;
                      $product_id = $result[$count_id]['id'] ;
                      for($i = 0; $i < count($Errors); $i ++){
                        $sql = 'INSERT INTO image_library (product_id, path) VALUES ("'.$product_id.'", "'.$Errors[$i].'")';
                        execute($sql);
                      }
                    } else {
                      for($i = 0; $i < count($Errors); $i ++){
                        $sql = 'INSERT INTO image_library (product_id, path) VALUES ("'.$id.'", "'.$Errors[$i].'")';
                        execute($sql);
                      }
                     
                    }
                  }
                  $sql = "INSERT INTO `voteproduct` (`id`, `id_product`, `QuanlityStar1`, `QuanlityStar2`, `QuanlityStar3`, `QuanlityStar4`, `QuanlityStar5`) VALUES (NULL, ".$value['id'].", '0', '0', '0', '0', '0')" ;
                  execute($sql);
                  header('location:index.php');
                } 
          }
     }
?>
<?php 
 include './Footer/footer.php';
 
?>
  <!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="../Ckeditor/resources/ckeditor/ckeditor.js"> </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
      @media only screen and (max-width: 570px) {
        .nav-mobile {
          display : block !important;
      }
      .nav-detok {
        display : none ;
      }
      .body-content {
           position : relative ;
           top : -290px !important;
           width : 100% !important;
        }
      }
      @media only screen and (max-width: 1000px) {
        .body-content {
           float : none !important;
           margin : 300px 0px 0px 0px !important;
           width : 100% !important;
        }
        .nav-detok .nav-item {
        border-bottom : none;
        float : left !important;
        }
        .nav-detok {
          margin : 12px 0px 0px 0px !important;
          width : 100% !important;
        }
      }
      .navbar-dark {
        background :#929292 !important;
      }
      .collapse {
        float : right !important;
      }
     
      .image-nav {
          float : left ;
          margin-right : 5px ;
      }
      .nav-link {
          float : left !important;
      }
      .navbar-brand {
          float : left ;
      }
      .nav-mobile {
          margin : 15px 0px 0px 0px;
          border-top : 2px solid white ;
          display : none ;
          padding-top : 15px ;
      }
      .nav-mobile img {
          margin-left : 12px ;
      }
      .nav-mobile .nav-item {
          margin-top : 15px ;
      }
      .nav-detok {
        border : 1px solid #000000;
        width : 15% ;
        border-radius : 5px ;
        margin : 12px ;
        float : left ;
      }
      .nav-detok li {
        border-bottom : 1px dotted #000000;
        margin-top : 10px;
      }
      .body-content {
        float : right ;
        border : 1px solid #000000;
        width : 80%;
        
        border-radius : 5px ;
        margin : 12px ;
      }
      .body-content h1 {
  font-size : 20px;
    background : black ;
    text-align : center ;
    color : white ;
    padding : 10px ;
      }
      .btn-success {
        float : right ;
        margin : 12px ;
      }
      .p-3 span {
        margin-left : 8px ;
        color : red ;
      }
      .p-3 {
       // height : 220px ;
      }
      #link{
        background : #e40707;
      }
      #link, #systemp {
        margin : 15px 0px 25px 0px ;
      }
      .all-file {
        display : none ;
      }
      .none {
        display : block;
      }
      .show-all-file img {
        
         margin : 5px ;
      }
      .show-all-file .Display-image {
        border : 1px solid #000000 ;
        border-radius : 8px ;
        float : left ;
        
      }
      .show-all-file .Display-image {
        margin : 15px  !important;
      
      }
      .btn-delete {
        float : left ;
         position : relative ;
        top : 2px ;
        left : 2px ;
      }
      .form-group span {
           color : red ;
      }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Xin Chào Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <li class="nav-item">
        <img class="image-nav" src="https://cdn4.iconfinder.com/data/icons/seo-and-digital-marketing-6-2/128/285-512.png" width="40" height="40">
        <a class="nav-link" href="Change.php">Thay Đổi Thông Tin</a>
      </li>
      <li class="nav-item">
        <img class="image-nav" src="https://noithattinnghia.com/wp-content/uploads/2019/03/cropped-icon-home-cam.png" width="40" height="40">
        <a class="nav-link" href="index.php">Trang Chủ</a>
      </li>
      <li class="nav-item">
      <img class="image-nav" src="https://image.flaticon.com/icons/png/512/277/277210.png" width="37" height="37">
        <a class="nav-link" href="Logout.php">Đăng Xuất</a>
      </li>  
    </ul>
   
    <div class="nav-mobile"> 
    <ul class="navbar-nav">
      <li class="nav-item">
        <img class="image-nav" src="https://upload.wikimedia.org/wikipedia/commons/6/6d/Windows_Settings_app_icon.png" width="40" height="40">
        <a class="nav-link" href="#">Cấu Hình</a>
      </li>
      <li class="nav-item">
      <img class="image-nav" src="https://png.pngtree.com/png-vector/20190725/ourlarge/pngtree-vector-newspaper-icon-png-image_1577280.jpg" width="40" height="40">
        <a class="nav-link" href="#">Tin Tức</a>
      </li>  
      <li class="nav-item">
      <img class="image-nav" src="https://ipos.vn/wp-content/uploads/2020/01/icon-12.png" width="40" height="40">
        <a class="nav-link" href="#">Sản Phẩm</a>
      </li>  
      <li class="nav-item">
      <img class="image-nav" src="https://vanchuyentrungquoc247.com/wp-content/uploads/2015/04/icon-3.png" width="45" height="45">
        <a class="nav-link" href="#">Đơn Hàng</a>
      </li>  
    </ul>
    </div>
  </div>  
</nav>
  
    <div style="border : 1px solid #000000" class="wp-content">
    <div class="nav-detok"> 
        
    <ul class="navbar-nav">
    <li style=" background : black;
    color : white;
    padding : 15px;
    margin:0px;
    text-align : center;
    font-size : 20px ;"   > Admin Menu</li>
      <li class="nav-item">
        <img class="image-nav" src="https://upload.wikimedia.org/wikipedia/commons/6/6d/Windows_Settings_app_icon.png" width="40" height="40">
        <a class="nav-link" href="#">Cấu Hình</a>
      </li>
      <li class="nav-item">
      <img class="image-nav" src="https://png.pngtree.com/png-vector/20190725/ourlarge/pngtree-vector-newspaper-icon-png-image_1577280.jpg" width="40" height="40">
        <a class="nav-link" href="#">Tin Tức</a>
      </li>  
      <li class="nav-item">
      <img class="image-nav" src="https://ipos.vn/wp-content/uploads/2020/01/icon-12.png" width="40" height="40">
        <a class="nav-link" href="#">Sản Phẩm</a>
      </li>  
      <li class="nav-item">
      <img class="image-nav" src="https://vanchuyentrungquoc247.com/wp-content/uploads/2015/04/icon-3.png" width="45" height="45">
        <a class="nav-link" href="#">Đơn Hàng</a>
      </li>  
    </ul>
    </div> -->
    <style>
    .p-3 span {
        margin-left : 8px ;
        color : red ;
      }
      .p-3 {
       // height : 220px ;
      }
      #link{
        background : #e40707;
      }
      #link, #systemp {
        margin : 15px 0px 25px 0px ;
      }
      .all-file {
        display : none ;
      }
      .none {
        display : block;
      }
      .show-all-file img {
        
         margin : 5px ;
      }
      .show-all-file .Display-image {
        border : 1px solid #000000 ;
        border-radius : 8px ;
        float : left ;
        
      }
      .show-all-file .Display-image {
        margin : 15px  !important;
      
      }
      .btn-delete {
        float : left ;
         position : relative ;
        top : 2px ;
        left : 2px ;
      }
      .form-group span {
           color : red ;
      }
    </style>
    <div class="body-content">
   <?php
      $char_rum = "'";
   ?>
     <?php
      if (isset($_GET['id'])){
        if (isset($_GET['takes'])){
             echo '<h1> Copy Sản Phẩm '.$char_rum.''.$name.''.$char_rum.'</h1>';
        } else {
            echo ' <h1>Sửa Sản Phẩm '.$char_rum.''.$name.''.$char_rum.' </h1>';
        }
      } else {
          echo '<h1> Thêm Sản Phẩm</h1>';
      }
     
     ?>
    <div class="container">
     <div class="col">
     <form action="" method="POST" enctype="multipart/form-data">
     <div class="form-group">
  <label for="usr">Tên Sản Phẩm:</label>
  <br/><span>  <?=$char_error_name?></span>
  <input value="<?=$name?>" name="name" type="text" class="form-control" id="usr">
</div>
<div class="form-group">
<label for="usr">Danh mục:</label>
<br/><span>  <?=$char_error_name_parent_id?></span>

      <select class="form-control" id="sel1" name="name_parent_id">
        <option value="0"> Lựa Chọn</option>
        <?php
        foreach ($menuTree as $key) { 
        ?>
        
         <option 
         <?php
           if ($key['id'] == $name_parent_id){
             echo 'selected';
           }
         
         ?> 
         value="<?=$key['id']?>">  
         <?php
           for ($i = 0; $i <= $key['lever']; $i ++){
             echo '- ';
           } echo $key['name']. "<br/>";
           echo '</option>';
        }
        ?> 
      </select>
      </div>
<div class="container p-3 my-3 border">
  <h6> Ảnh Đại Diện : </a> </br>

     <img style="margin-top : 20px" id="change_image" src="<?=$image?>" width="150" height="150"> <br/> <br/>
  
     <div id="link" class="btn btn-primary">Link Ảnh</div>
     <div id="systemp" class="btn btn-primary">Chọn Từ Thiết Bị</div>
     <div class="form-group input-file">
  <input onchange = "updateThumbnail()" value="<?php
    if(!empty($image) && $image[0] != '.'){
      echo $image;
    }
  ?>" placeholder="Link hình ảnh" name="image" type="text" class="form-control" id="thumbnail">
</div>
<div class="custom-file mb-3 all-file">
    <input  type="file" class="custom-file-input" id="customFile" name="file_image[]">
      <label class="custom-file-label" for="customFile">Từ thiết bị này</label>
    </div> 
    <?php
         if ($Error_file_image != ''){
             echo '<span> '.$Error_file_image.' </span>';
         } 
    ?>
</div>
<div style="clear : both"> </div>
<div class="container p-3 my-3 border">

  <h6> Thư viện ảnh : </a> </br> <br/>
  <div class="show-all-file">
        <?php
        if ($Copy == false && isset($_GET['id'])){
       $sql = "SELECT * FROM `image_library` WHERE `product_id` = '".$_GET['id']."' ORDER BY `product_id` ASC" ;
       $result = executeResult($sql) ;
      
       foreach ($result as $key){
?>
            
                <div class="Display-image">
                <img src="<?=$key['path']?>" width="150" height="200">
                <button onclick="deleteimage('<?=$key['path']?>')"type="button" class="btn btn-delete btn-danger">Xóa</button>
           </div>
<?php    
       }
      } 
        ?>
  <div style="clear : both"> </div>
  <br/>
  
<div class="custom-file mb-3 all-file none">
    <input multiple type="file" class="custom-file-input" id="customFile" name="full_file_image[]">
     <label class="custom-file-label" for="customFile">Từ thiết bị này</label>
    </div> 
     <?php
           if($UploadFile_Errors == true){
            for($i = 0; $i < count($Errors); $i ++){
              if ($Errors[$i] == 1) continue;
              $char_name = $Errors[$i];
              if($char_name[0] != '.'){
                 // echo $Errors[$i]. "<br/>";
                 echo '<span> '.$Errors[$i].' </span><br/>';
              }
           }
        }
     // 
     ?>
</div>
<div class="form-group">
  <label for="usr">Giá Mới:</label>
  <br/><span>  <?=$char_error_giamoi?></span>
  <input value="<?=$giamoi?>" name="giamoi" type="number" class="form-control" id="usr">
</div>
<div class="form-group">
  <label for="usr">Giá Cũ:</label>
  <br/><span>  <?=$char_error_giacu?></span>
  <input value="<?=$giacu?>" name="giacu" type="number" class="form-control" id="usr">
</div>
<div class="form-group">
  <label for="usr">Nội Dung:</label>
  <br/><span>  <?=$char_error_content?></span>
  <textarea type = "text" class="form-control" rows="5" id="content" name="lol"> <?=$content?> </textarea>
</div>
 <button style="margin : 15px" type="submit" class="btn btn-danger">Xác Nhận</button>
  </form>
     </div> 
    </div>
    </div>
    </div>
    <script type = "text/javascript">
      function updateThumbnail(){
             $('#change_image').attr('src' , $('#thumbnail').val()) ;
       } 
     CKEDITOR.replace('content');
    </script>
    <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script> 
$(document).ready(function() {
$('#link').on('click', function(){
  $('#link').css('background','#e40707');
  $('#systemp').css('background','blue');
  $('.input-file').css('display','block');
  $('.all-file').css('display','none');
  $('.none').css('display','block');
});
$('#systemp').on('click', function(){
  $('#systemp').css('background','#e40707');
  $('#link').css('background','blue');
  $('.input-file').css('display','none');
  $('.all-file').css('display','block');
});

});
</script>
<script type="text/javascript">
          function deleteimage(url){
      // console.log(url);
             option = confirm('Bạn có muốn xóa ảnh này không ??') ;
              if (!option){
                  return (0) ;
              }
               //  console.log(id) ;
                $.post('delete.php', {
                        'url': url 
                }, function(data){
                    alert(data) ;
                     location.reload() ;
                }) 
          } 
       </script>
</body>
</html>
