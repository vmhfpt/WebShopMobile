<?php
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./Help.php') ;
  $sql = 'SELECT * FROM nokia';
  $Search = false ;
  $Name_admin = $_SESSION['login']['printf_name'];
  $Search_Error = $search_name = $search_id = '';
  
  if(!empty($_GET)){
   
     if (isset($_GET['search_name']) && isset($_GET['search_id'])){
      $search_name = $_GET['search_name'];
      $search_id = $_GET['search_id'];
      if ($search_id == '' && $search_name == ''){
        $Search_Error = '* Không được để trống';
      }
      if ($search_id != '' && $search_name != ''){
           $Search_Error = '* Chỉ lựa chọn một cách tìm kiếm';
      }
       if ( $Search_Error == ''){
            if($search_name != ''){
              $_SESSION['Search_name'] = $search_name;
              $Search = true;
            } else {
              $sql = 'SELECT * FROM nokia WHERE id = ' . $_GET['search_id'] ;
                $_SESSION['Search_name'] = null ;
                $Search = true;
            } 
       } else {
           $_SESSION['Search_name'] = null ;
       }
     }
    }
    if( $_SESSION['Search_name'] != null) {
       // echo   $_SESSION['Search_name'] ;
        $sql = 'SELECT * FROM nokia WHERE name like "%'.$_SESSION['Search_name'].'%"';
    }
?>
<?php 
 include './Footer/footer.php';
 
?>
 <!--<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin || Quản lý sản phẩm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
           margin : 340px 0px 0px 0px !important;
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
      .search-product {
        margin : 12px ;
          border : 1px solid #000000;
          border-radius : 5px ;
          width : 65%;
          height : 170px ;
      }
      #id_seach{
        margin-left : 7px ;
          width : 45% ;
          float : left ;
          margin-right : 7px;
      }
      #name_searche{
        width : 45% ;
        float : left ;
      }
      .btn-dark {
        margin : 12px;
      }
      .search-product h5 {
           margin : 12px ;
      }
      .search-product span {
        margin-left : 12px ;
        color : red;
      }
      .pagination {
        margin-left : 22px ;
        position : fixed !important;
        z-index : 999 !important;
        bottom : 0;
        //left : 0;
      }
      h6>i {
        color : red  !important;
      }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="Change.php">Xin Chào <span style="color : orange"><?=$Name_admin?> </span></a>
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
        <img class="image-nav" src="https://png.pngtree.com/png-vector/20191129/ourlarge/pngtree-office-checklist-icon-business-checklist-survey-test-icon-png-image_2047566.jpg" width="40" height="40">
        <a class="nav-link" href="category.php">Danh Mục</a>
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
        <img class="image-nav" src="https://png.pngtree.com/png-vector/20191129/ourlarge/pngtree-office-checklist-icon-business-checklist-survey-test-icon-png-image_2047566.jpg" width="40" height="40">
        <a class="nav-link" href="category.php">Danh Mục</a>
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
    <div  style = "display : none;
    position : fixed;
margin-top : 50px;
z-index : 1000 ;" class="alert alert-success"> 
    <strong>Thành công!</strong> <span id = "alert-text"></span>
  </div>
      <h1> Danh Sách Sản Phẩm </h1>
    <a href="product.php"> <button type="button" class="btn btn-success">Thêm Sản Phẩm</button> </a>
    
    <div class="search-product">
       <form method="GET" action="">
           <center><h5> Tìm Kiếm Sản Phẩm</h5></center>
           <input value="<?= $search_id?>" name="search_id" type="number" class="form-control" placeholder="Enter Your Key Search Id product" id="id_seach">
           <input value="<?=$_SESSION['Search_name']?>" name="search_name" type="text" class="form-control" placeholder="Enter Your Key Search Name product" id="name_searche">
            <div style="clear : both"></div>
            <span> <?=$Search_Error?></span><br/>
           <button type="submit" class="btn btn-dark">Tìm Kiếm</button>
           <div style="float:right; margin : 12px 12px 0px 0px" class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
       Phân Loại Sản Phẩm
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="product_edit.php?action=1">Sản phẩm bán chạy</a>
      <a class="dropdown-item" href="product_edit.php?action=2">Sản phẩm mua nhiều nhất</a>
    </div>
</div>
           </form>
    </div>
    <?php
      if(isset($_GET['search_id']) && $Search_Error == '' || (!isset($_GET['search_id']) && $_SESSION['Search_name'] != null)){
        ?>
              <h5 style="margin-left : 12px"> Kết quả tìm Kiếm <?php
                  if (isset($_GET['search_id']) && $_GET['search_id'] != ''){
                        echo "ID = '".$search_id. "'" ;
                  }else {
                        echo "Name = '" . $_SESSION['Search_name']. "'" ;
                  }
              ?> </h5>
   <?php   } ?>
   
  <table class="table table-bordered">
    <thead>
      <tr style="text-align : center">
         <th> Id</th>
        <th>Ảnh</th>
        <th>Tên Sản Phẩm</th>
        <th>Copy</th>
        <th>Sửa</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
      <?php
       $data = executeResult($sql) ;
      $current_page = 1 ;
      $limit = 6;
      if (isset($_GET['page'])){
            $current_page = $_GET['page'] ;
      }
     $index = ($current_page - 1) * $limit ; 
     if ($Search == false && $_SESSION['Search_name'] == null){
           $sql = 'SELECT * FROM nokia LIMIT '. $limit .' OFFSET '. $index .'';
     } else {
         if(isset($_GET['search_name']) && $_GET['search_name'] != '' || $_SESSION['Search_name'] != null) {
              $sql = 'SELECT * FROM nokia WHERE name like "%'.$_SESSION['Search_name'].'%" LIMIT '. $limit .' OFFSET '. $index .'';
         }
         if(isset($_GET['search_id']) && $_GET['search_id'] != '' && $_SESSION['Search_name'] == null)  {
             $sql = 'SELECT * FROM nokia WHERE id = ' . $_GET['search_id'] ;
         }
     }
         $result = executeResult($sql) ;
      if (count($result) > 0) {
          foreach ($result as $key) {
      ?>
      <tr>
      <td> <?=$key['id']?></td>
        <td><img src="<?=$key['image']?>" width="80" height="80"/></td>
        <td><?=$key['name']?></td>
        <td><center><a href="product.php?id=<?=$key['id']?>&takes=copy"><button type="button" class="btn btn-primary">Copy</button> </a></center></td>
        <td> <center><a href="product.php?id=<?=$key['id']?>"><button type="button" class="btn btn-warning">Sửa</button> </a> </center></td>
        <td> <center> <button onclick="deleteStudent(<?=$key['id']?>,'<?=$key['image']?>')" type="button" class="btn btn-danger">Xóa</button></center></td>
      </tr>
     <?php }}else {
        echo '<center><h5> Không có kết quả nào </h5> </center> ' ;
     }
       ?>
       <h6 style="float: right;
         margin-right : 12px "> Có tất cả <i><?=count($data)?></i> Sản Phẩm trên <i><?=ceil(count($data)/$limit)?></i> trang</h6>
    </tbody>
  </table>
  <ul class="pagination">
<?php

    $Page_start = 1 ;
     if (($current_page - 2) > 0 ){
         $Page_start = $current_page - 2 ;
     }
     $Page_end = ceil(count($data)/$limit) ;
     if (($current_page + 2 <= ceil(count($data)/$limit))){
         $Page_end = $current_page + 2;
     } 
     if (($current_page - 2) <= 0 && $current_page + 1 <= ceil(count($data)/$limit)){
      $Page_end = $current_page + 1;
     }
     if (($current_page + 2) > ceil(count($data)/$limit) && $current_page - 1 > 0){
      $Page_start = $current_page - 1 ;
     }
   if (($current_page - 2) > 0 ){
      echo '<li class="page-item"><a class="page-link" href="index.php?page='.($current_page - 1).'">Previous</a></li>';
   }
    for ($i = $Page_start; $i <= $Page_end; $i ++)  {
    ?>
          <li class="page-item  <?php 
     if ($i == $current_page){
         echo 'active';
     }
  ?>"><a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a></li> 
    <?php } ?>
    <?php
    if (($current_page + 2) <= ceil(count($data)/$limit)){
        echo ' <li class="page-item"><a class="page-link" href="index.php?page='.($current_page + 1).'">Next</a></li>';
     }
?>
</ul>
    </div>
    </div>
   
    <script type="text/javascript">
          function deleteStudent(id,url){
              option = confirm('Bạn có muốn xóa Tài khoản này không !!!') ;
              if (!option){
                  return (0) ;
              }
                $.post('delete.php', {
                        'id': id,
                        'url1': url
                }, function(data){
                    var text = data ;
                   
                 document.getElementById('alert-text').innerHTML = text;
                 $('.alert').slideToggle(200);
                 $(function(){
                     var myFnc = function(){
                      $('.alert').slideToggle(700);
                   };
                   var myFnc1 = function(){
                      location.reload() ;
                   };
                  setTimeout(myFnc, 3000);
                  setTimeout(myFnc1, 3500);
                 });
                    // location.reload() ;
                })
          }
       </script> 
    

</body>
</html>
