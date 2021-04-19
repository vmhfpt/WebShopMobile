<?php
// Chức năng này để lại
// học xong ajax trong javascript rồi hãy quay lại
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./Help.php') ;
  function boolened($id){
    $sql = 'SELECT * FROM `selling_products`';
    $result = executeResult($sql);
    foreach($result as $key => $value){
      if($value['id_product'] == $id){
         return (false);
      }
    }
    return (true);
}
  if(!empty($_POST)){

    if(isset($_POST['optradio'])){
      //  var_dump($_POST['optradio']);die();
        foreach ($_POST['optradio'] as $key){
            $boolened = boolened($key);
           if($boolened == true){
            $sql_add = 'INSERT INTO `selling_products` (`id`, `id_product`) VALUES (NULL, '.$key.')';
            execute( $sql_add);
           }
        } 
    header('location:product_edit.php?action=2');
    }
  
 }
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
<style>
  .BtnDelete{
    right : 12px;
        position : fixed !important;
        z-index : 999 !important;
        bottom : 13px;
        
}
  
</style>
    <div class="body-content">
    <div  style = "display : none;
    position : fixed;
margin-top : 50px;
z-index : 1000 ;" class="alert alert-success"> 
    <strong>Thành công!</strong> <span id = "alert-text"></span>
  </div>
      <h1> Thêm Sản Phẩm Mua Nhiều Nhất </h1>
    
    
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
   <form action="" method="POST">
  <table class="table table-bordered">
    <thead>
      <tr style="text-align : center">
         <th> Id</th>
        <th>Ảnh</th>
        <th>Tên Sản Phẩm</th>
        <th>Đánh Dấu</th>
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
        <td><center> <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="optradio[]" value="<?=$key['id']?>">
      </label>
    </div></center></td>
       
      </tr>
     <?php }}else {
        echo '<center><h5> Không có kết quả nào </h5> </center> ' ;
     }
       ?>
       <h6 style="float: right;
         margin-right : 12px "> Có tất cả <i><?=count($data)?></i> Sản Phẩm trên <i><?=ceil(count($data)/$limit)?></i> trang</h6>
    </tbody>
  </table>
  <button style="float:right" type="submit" class="BtnDelete btn btn-dark">Xác Nhận</button>
  </form>
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
      echo '<li  class="page-item"><a  class="page-link" href="product.add2.php?page='.($current_page - 1).'">Previous</a></li>';
   }
    for ($i = $Page_start; $i <= $Page_end; $i ++)  {
    ?>
          <li  class="page-item  <?php 
     if ($i == $current_page){
         echo 'active';
     }
  ?>"><a  class="page-link" href="product.add2.php?page=<?=$i?>"><?=$i?></a></li> 
    <?php } ?>
    <?php
    if (($current_page + 2) <= ceil(count($data)/$limit)){
        echo ' <li  class="page-item"><a  class="page-link" href="product.add2.php?page='.($current_page + 1).'">Next</a></li>';
     }
?>
</ul>
    </div>
    </div>
   

</body>
</html>
