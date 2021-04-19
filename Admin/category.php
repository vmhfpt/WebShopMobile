<?php
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./function.php') ;
  require_once ('./Help.php') ;
  $Number = 0;
  $Search = false ;
  $Name_admin = $_SESSION['login']['printf_name'];
  $Search_Error = $search_name = '';
  //SELECT * FROM `menu` WHERE `name` = 'lever 1' ORDER BY `parent_id` ASC
  if(!empty($_GET)){
     if (isset($_GET['search_name']) && $_GET['search_name'] != ''){
      $Search = true;
      $search_name = $_GET['search_name'];
      $Search = true;
      $result_parent ='SELECT * FROM `menu` WHERE `name` = "'.$search_name.'" ORDER BY `parent_id` ASC' ;
      $Number_parent = executeSingleResult($result_parent);
     // var_dump($Number_parent); die();
      if ($Number_parent != null){
         $Number = $Number_parent['id'];
      } else {
        $Number = -1 ;
      }
     }
    }
    if($search_name == ''){
      $Search_Error = '* Không được để trống';
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
      #name_searche{
        width : 45% ;
        margin-left : 12px;
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
      <h1> Danh Sách Danh Mục </h1>
    <a href="category_edit.php"> <button type="button" class="btn btn-success">Thêm Danh Mục</button> </a>
    <div class="search-product">
       <form method="GET" action="">
           <center><h5> Tìm Kiếm Danh Mục</h5></center>
           <input value="<?=$search_name?>" name="search_name" type="text" class="form-control" placeholder="Enter Your Key Search Name Category" id="name_searche">
            <div style="clear : both"></div>
            <span style="margin-;eft : 12px"> <?=$Search_Error?></span><br/>
           <button type="submit" class="btn btn-dark">Tìm Kiếm</button>
           </form>
    </div>
    <?php
      if(isset($_GET['search_name']) && $Search_Error == '' ){
        ?>
              <h5 style="margin-left : 12px"> Kết quả tìm Kiếm <?php
                  if (isset($_GET['search_name'])){
                        echo "danh mục = '".$search_name. "'" ;
                  }
              ?> </h5>
   <?php   } ?>
   <?php
   
   if ($Number == -1){
     echo '<center> <h5> Không có kết quả nào</h5></center>';
   }else {
   ?>
  <table class="table table-bordered">
    <thead>
      <tr style="text-align : center">
        <th>Tên Danh Mục</th>
        <th>Copy</th>
        <th>Sửa</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
   <?php
     function RamDomList($menuList, $parent_id){
       $Temp_Parent_id = $parent_id;
      $menuTree = array();
      foreach($menuList as $key){
        if ($key['id'] == $parent_id){
          $menuTree[] = $key;break;
        }
      }
       foreach($menuList as $key){

           if ($key['parent_id'] == $Temp_Parent_id){
              $Temp_Parent_id = $key['id'];
              $menuTree[] = $key;
           }
       }
         return($menuTree);
     }
   ?>
      <?php
      //echo $Number; die();
            $sql = "SELECT * FROM menu";
             $result = executeResult($sql) ;
             $menuTree = createMenuTree($result, 0, 0);
            $result_List = RamDomList($menuTree, $Number);
            if($Search == false){
              $result_List = $menuTree;
            }
            foreach($result_List as $menu){
      ?>
          <tr>
          <?php
         echo '<td>';
           for ($i = 0; $i <= $menu['lever']; $i ++){
             echo '- ';
           } echo $menu['name']. "<br/>";
           echo '</td>';
        ?> 
    <td><center><a href="category_edit.php?id=<?=$menu['id']?>&takes=copy"><button type="button" class="btn btn-primary">Copy</button> </a></center></td>
        <td> <center><a href="category_edit.php?id=<?=$menu['id']?>"><button type="button" class="btn btn-warning">Sửa</button> </a> </center></td>
        <td> <center> <button onclick="deleteMenuChildren(<?=$menu['id']?>)" type="button" class="btn btn-danger">Xóa</button></center></td>
     </tr>
 
       <?php } ?>

    </tbody>
    <!--<tbody>
onclick="deleteMenuChildren(<?=$menu['id']?>)"
      <tr>
      <td> dfdffs</td>
      
        <td><center><a href="product.php?id=<?=$key['id']?>&takes=copy"><button type="button" class="btn btn-primary">Copy</button> </a></center></td>
        <td> <center><a href="product.php?id=<?=$key['id']?>"><button type="button" class="btn btn-warning">Sửa</button> </a> </center></td>
        <td> <center> <button onclick="deleteStudent(<?=$key['id']?>,'<?=$key['image']?>')" type="button" class="btn btn-danger">Xóa</button></center></td>
      </tr>
      <tr>
      <td> dfdffs</td>
      
        <td><center><a href="product.php?id=<?=$key['id']?>&takes=copy"><button type="button" class="btn btn-primary">Copy</button> </a></center></td>
        <td> <center><a href="product.php?id=<?=$key['id']?>"><button type="button" class="btn btn-warning">Sửa</button> </a> </center></td>
        <td> <center> <button onclick="deleteStudent(<?=$key['id']?>,'<?=$key['image']?>')" type="button" class="btn btn-danger">Xóa</button></center></td>
      </tr>
    </tbody>-->
  </table>
 <?php } ?>
    </div>
    </div>
    <script type="text/javascript">
          function deleteMenuChildren(id){
      // console.log(url);
             option = confirm('Bạn có muốn xóa ảnh này không ??') ;
              if (!option){
                  return (0) ;
              }
               //  console.log(id) ;
                $.post('delete_category.php', {
                        'id': id 
                }, function(data){
                    alert(data) ;
                     location.reload() ;
                }) 
          } 
       </script>
</body>
</html>
