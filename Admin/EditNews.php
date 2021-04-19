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
             $sql = 'SELECT * FROM news WHERE id = '. $id;
             $result = executeResult($sql);
             $name = $result[0]['title'];
             $image = $result[0]['image'];
             $Temp_image = $image;
             $id_product = $result[0]['id_product'];
             $date = $result[0]['create_date'];
             $content = $result[0]['content'];
             $description = $result[0]['description'];
      }
   }
     if(!empty($_POST)){
          if(isset($_POST['name'])){
             $name = $_POST['name'];
             if($name == ''){
                $char_error_name = '* Tiêu đề tin tức không được để trống';
             }
          }
          if(isset($_POST['image'])){
             $image = $_POST['image'];
             
          }
          if(isset($_POST['id_product'])){
             $id_product = $_POST['id_product'];
          }
          if(isset($_POST['date'])){
            $date = $_POST['date'];
            if($date == ''){
              $char_error_date = '* Ngày tháng năm không được để trống';
             }
         } 
         if(isset($_POST['description'])){
            $description = $_POST['description'];
            if($description == ''){
              $char_error_description = '* Mô tả ngắn không được để trống';
             }
         } 
         if(isset($_POST['content'])){
            $content = $_POST['content'];
            $content = str_replace('"', '\\"', $content) ;
            if ($content == ''){
              $char_error_content = '* Nội dung không được để trống';
            }
         }
      /*   echo $name . "<br/>";
         echo $image . "<br/>";
         echo $id_product . "<br/>";
         echo   $content . "<br/>";
         echo   $description  . "<br/>";
         die(); */
        
     }
     if ($image == '' && $Value_image == false){
      $Error_file_image = '* Bạn chưa chọn ảnh nào';
     } 
     if ($image != '' && $Value_image == true){
      $Error_file_image = '* Chỉ lựa chọn 1 cách tải ảnh lên';
     }
    
     if($name != '' &&  $description != '' && $id_product != '' && $date != '' && $content != ''){
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
        //  echo $Error_file_image; die();
          if($Error_file_image == ''){
             //   echo '<br/>Cho upload thu vien anh<br/>';
               
              
                  if(!isset($_GET['id']) || $Copy == true){
                      $sql = 'INSERT INTO news (id_product, title, description, content, image, create_date) VALUES ("'.$id_product.'", "'.$name.'", "'.$description.'", "'.$content.'", "'.$image.'", "'.$date.'")';
                      execute($sql);
                      header('location:News.php');
                      //var_dump($sql);
                    //  die();
                   //  $sql = 'INSERT INTO nokia (name, image, giacu, giamoi, content, category) VALUES ("'.$name.'", "'.$image.'", "'.$giacu.'", "'.$giamoi.'", "'.$content.'", "'.$name_parent_id.'")' ;
                   // $id_vote = execute($sql) ;


                   //  $sqlVote = "INSERT INTO `voteproduct` (`id`, `id_product`, `QuanlityStar1`, `QuanlityStar2`, `QuanlityStar3`, `QuanlityStar4`, `QuanlityStar5`) VALUES (NULL, ".$id_vote.", '0', '0', '0', '0', '0')" ;
                     
                   //  var_dump($sqlVote); die();
                  //  execute($sqlVote);

                  } else if($Copy == false){
                     //  $sql = 'UPDATE nokia SET name = "'.$name.'", content = "'.$content.'", category = "'.$name_parent_id.'", image = "'.$image.'", giacu = "'. $giacu.'", giamoi = "'.$giamoi.'" WHERE id = '.$id ;
                     //  execute($sql) ;
                     //  if($Temp_image[0] == '.'){
                     //   unlink($Temp_image);
                     }
                  }
                //  $sql = "INSERT INTO `voteproduct` (`id`, `id_product`, `QuanlityStar1`, `QuanlityStar2`, `QuanlityStar3`, `QuanlityStar4`, `QuanlityStar5`) VALUES (NULL, ".$value['id'].", '0', '0', '0', '0', '0')" ;
                 // execute($sql);
                //  header('location:index.php');
                
          }
     
?>
<?php 
 include './Footer/footer.php';
 
?>

    <style>
    .p-3 span {
        margin-left : 8px ;
        color : red ;
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
            echo ' <h1>Sửa Tin Tức Id =  '.$char_rum.''. $id.''.$char_rum.' </h1>';
        }
      } else {
          echo '<h1> Thêm Tin Tức</h1>';
      }
     
     ?>
    <div class="container">
     <div class="col">
     <form action="" method="POST" enctype="multipart/form-data">
     <div class="form-group">
  <label for="usr">Tiêu đề tin tức:</label>
  <br/><span>  <?=$char_error_content?></span>
  <textarea type = "text" class="form-control" rows="5"  name="name"> <?=$content?> </textarea>
</div>
<div class="form-group">
  <label for="usr">Id sản phẩm :</label>
  <br/><span> * Nếu có</span>
  <input value="<?=$id_product?>" name="id_product" type="number" class="form-control" id="usr">
</div>
<div class="form-group">
  <label for="usr">Ngày/Tháng/Năm:</label>
  <br/><span>  <?=$char_error_name?></span>
  <input value="<?=$date?>" name="date" type="text" class="form-control" id="usr">
</div>
<div class="container p-3 my-3 border">
  <h6> Ảnh Đại Diện Cho Tin: </a> </br>

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

<div class="form-group">
  <label for="usr">Mô tả ngắn:</label>
  <br/><span>  <?=$char_error_content?></span>
  <textarea type = "text" class="form-control" rows="5"  name="description"> <?=$description?> </textarea>
</div>
<div class="form-group">
  <label for="usr">Nội Dung:</label>
  <br/><span>  <?=$char_error_content?></span>
  <textarea type = "text" class="form-control" rows="5" id="content" name="content"> <?=$content?> </textarea>
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
