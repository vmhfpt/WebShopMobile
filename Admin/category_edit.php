<?php
 
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./Help.php') ;
  require_once ('./function.php') ;
  $Name_admin = $_SESSION['login']['printf_name'];
         // WHERE (parent_id = 0 OR parent_id = 4)
         $name_category = $name_parent_id = $oder = $link = '';
        $sql = "SELECT * FROM menu";
       $result = executeResult($sql) ;
       $menuTree = createMenuTree($result, 0, 0);
        /*foreach ($menuTree as $key) {
           for ($i = 0; $i <= $key['lever']; $i ++){
             echo '- ';
           } echo $key['name']. "<br/>";
        } 
       die();  */
       if(!empty($_GET)){
        
         if(isset($_GET['id'])){
            $id = $_GET['id'];
         }
         $sql = 'SELECT * FROM menu WHERE id = '.$id;
         $result = executeSingleResult($sql);
         $name_category = $result['name'];
         $name_parent_id = $result['parent_id'];
         //$sql_selected = 'SELECT * FROM menu WHERE id = '. $name_parent_id;
         $oder = $result['posistion'];
         $link = $result['link'];
     
       }
       if(!empty($_POST)){
          if(isset($_POST['name_category'])){
            $name_category = $_POST['name_category'];
          }
          if(isset($_POST['name_parent_id'])){
            $name_parent_id = $_POST['name_parent_id'];
          }
          if(isset($_POST['oder'])){
            $oder = $_POST['oder'];
          }
          if(isset($_POST['link'])){
            $link = $_POST['link'];
          }
          if (empty($_GET) && !isset($_GET['id'])){
            //echo $name_parent_id; die();
          $sql = 'INSERT INTO menu (name, parent_id, link, posistion) VALUES ("'.$name_category.'", "'.$name_parent_id.'", "'.$link.'", "'.$oder.'")';
          } else if(!isset($_GET['takes'])){
           // $sql = "UPDATE `menu` SET `link` = 'haha.php', `posistion` = '0', `menu`.`id`, `link` = 'haha.php', `link` = 'haha.php'  WHERE id = 23" ;
            $sql = "UPDATE `menu` SET `link` = '".$link."', `posistion` = '". $oder."', `parent_id` = '".$name_parent_id."', `name` = '".$name_category."' WHERE `menu`.`id` = '".$id."'";
            //var_dump($sql);die();
          }
          if (isset($_GET['takes'])){
            $sql = 'INSERT INTO menu (name, parent_id, link, posistion) VALUES ("'.$name_category.'", "'.$name_parent_id.'", "'.$link.'", "'.$oder.'")';
          }
          execute($sql);
          header('location:category.php');
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
    <div class="body-content">
   <?php
      $char_rum = "'";
   ?>
     <?php
      if (isset($_GET['id'])){
        if (isset($_GET['takes'])){
             echo '<h1> Copy Danh Mục '.$char_rum.''.$name_category.''.$char_rum.'</h1>';
        } else {
            echo ' <h1>Sửa Danh Mục '.$char_rum.''.$name_category.''.$char_rum.' </h1>';
        }
      } else {
          echo '<h1> Thêm Danh Mục</h1>';
      }
      
     ?>
    <div class="container">
     <div class="col">
     <form action="" method="POST">
     <div class="form-group">
  <label for="usr">Tên Danh Mục:</label>
  <br/><span> </span>
  <input value="<?=$name_category?>" name="name_category" type="text" class="form-control" id="usr">
</div>
<div class="form-group">
<label for="usr">Danh mục cha:</label>
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
<div class="form-group">
  <label for="usr">Link:</label>
  <br/><span> </span>
  <input value="<?=$link?>" name="link" type="text" class="form-control" id="usr">
</div>
<div class="form-group">
  <label for="usr">Thứ tự:</label>
  <br/><span> </span>
  <input value="<?=$oder?>" name="oder" type="text" class="form-control" id="usr">
</div>
<button style="margin-bottom : 12px" type="submit" class="btn btn-danger">Xác Nhận</button>
  </form>
     </div> 
    </div>
    </div>
    </div>
    
</body>
</html>
