<?php
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./Help.php') ;
  $Name_admin = $_SESSION['login']['printf_name'];
  if(isset($_GET['action'])){
    if($_GET['action'] == 1){
        // find id product your product abaut on databese 
       
      $sql = 'SELECT * FROM `products_bought`';
      $result = executeResult($sql);
     $char = '';
     foreach($result as $key => $value){
            $char = $char. $value['id_product']. ",";
     } 
     $char = substr($char, 0, -1);
     if($char == ''){
      $char = 0;
    }
    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')';
    
    } else {
      $sql = 'SELECT * FROM `selling_products`';
      $result = executeResult($sql);
     $char = '';
     foreach($result as $key => $value){
            $char = $char. $value['id_product']. ",";
     } 
     $char = substr($char, 0, -1);
 if($char == ''){
   $char = 0;
 }
    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.')';
    }
  }
  
 // $sql = 'SELECT * FROM `products_bought`';
 // var_dump($sql); die();
  //SELECT * FROM `nokia` WHERE `id` IN (302,303,304,305,306,307,308,309,310,311,312,313,320) LIMIT 6 OFFSET 6
?>
<?php 
 include './Footer/footer.php';
 
?>
 <style>
.deleteButton {
     right : 12px;
        position : fixed !important;
        z-index : 999 !important;
        bottom : 13px;
        display : none;
}


 </style>
    <div class="body-content">
      <div id="ResultDelete"></div>
    <div  style = "display : none;
    position : fixed;
margin-top : 50px;
z-index : 1000 ;" class="alert alert-success"> 
    <strong>Thành công!</strong> <span id = "alert-text"></span>
  </div>
      <h1> Danh Sách Sản Phẩm <?php
      
      if(isset($_GET['action'])){
        if($_GET['action'] == 1){
          echo 'Bán Chạy';
        } else {
          echo 'Mua Nhiều Nhất';
        }
      }
      
      
      ?></h1>
      <?php
      if(isset($_GET['action'])){
        if($_GET['action'] == 1){
          echo ' <a href="product_add.php?action=1"> <button type="button" class="btn btn-success">Thêm Sản Phẩm Bán Chạy</button> </a>';
        } else {
          echo '<a href="product.add2.php"> <button type="button" class="btn btn-success">Thêm Sản Phẩm Mua Nhiều Nhất</button> </a>';
        }
      }
      
      ?>
   
    
  
           <div style="float:left; margin : 12px 0px 0px 12px" class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
       Phân Loại Sản Phẩm
    </button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="product_edit.php?action=1">Sản phẩm bán chạy</a>
      <a class="dropdown-item" href="product_edit.php?action=2">Sản phẩm mua nhiều nhất</a>
    </div>
</div>
      <div style="clear:both"></div>     
  
   
   
  <table class="table table-bordered">
    <thead>
      <tr style="text-align : center">
         <th> Id</th>
        <th>Ảnh</th>
        <th>Tên Sản Phẩm</th>
        <th>Đánh dấu</th>
      </tr>
    </thead>
    <tbody>
      <?php
     if($_GET['action'] == 1){
     echo '  <form action="" method="POST" name="myForm"  onsubmit="return validateForm(1)">';
     }else {
       echo '<form action="" method="POST" name="myForm"  onsubmit="return validateForm(2)">';
     }
      ?>
  
    <?php
    
       $data = executeResult($sql) ;
     
      $current_page = 1 ;
      $limit = 6;
      if (isset($_GET['page'])){
            $current_page = $_GET['page'] ;
      }
     $index = ($current_page - 1) * $limit ; 
     
    // SELECT * FROM `nokia` WHERE `id` IN (302,303,304,305,306,307,308,309,310,311,312,313,320) LIMIT 6 OFFSET 0
    $sql = 'SELECT * FROM `nokia` WHERE `id` IN ('.$char.') LIMIT '. $limit.' OFFSET '.$index .' ';
    
         $result = executeResult($sql) ;
        
      if (count($result) > 0) {
          foreach ($result as $key) {
      ?>
      <tr>
      <td> <?=$key['id']?></td>
        <td><img src="<?=$key['image']?>" width="80" height="80"/></td>
        <td><?=$key['name']?></td>
        <td> <center> <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="optradio[]" value="<?=$key['id']?>">
      </label></center></td>
      </tr>
     <?php }}else {
        echo '<center><h5> Không có kết quả nào </h5> </center> ' ;
     }
       ?>
       <h6 style="float: right;
         margin-right : 12px "> Có tất cả <i><?=count($data)?></i> Sản Phẩm trên <i><?=ceil(count($data)/$limit)?></i> trang</h6>
         <button  type="submit" class="deleteButton btn btn-danger">Xóa</button>
         </form>
    </tbody>
  </table>
  <ul class="pagination">
<?php
 if($_GET['action'] == 1){
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
    
         echo '<li  class="page-item"><a  class="page-link" href="product_edit.php?page='.($current_page - 1).'&action=1">Previous</a></li>';
   }
    for ($i = $Page_start; $i <= $Page_end; $i ++)  {
    ?>
          <li  class="page-item  <?php 
     if ($i == $current_page){
         echo 'active';
     }
  ?>"><a  class="page-link" href="product_edit.php?page=<?=$i?>&action=1"><?=$i?></a></li> 
    <?php } ?>
    <?php
    if (($current_page + 2) <= ceil(count($data)/$limit)){
     
        echo ' <li  class="page-item"><a  class="page-link" href="product_edit.php?page='.($current_page + 1).'&action=1">Next</a></li>';
     
     }
    } else {

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
     
          echo '<li  class="page-item"><a  class="page-link" href="product_edit.php?page='.($current_page - 1).'&action=2">Previous</a></li>';
    }
     for ($i = $Page_start; $i <= $Page_end; $i ++)  {
     ?>
           <li  class="page-item  <?php 
      if ($i == $current_page){
          echo 'active';
      }
   ?>"><a  class="page-link" href="product_edit.php?page=<?=$i?>&action=2"><?=$i?></a></li> 
     <?php } ?>
     <?php
     if (($current_page + 2) <= ceil(count($data)/$limit)){
      
         echo ' <li  class="page-item"><a  class="page-link" href="product_edit.php?page='.($current_page + 1).'&action=2">Next</a></li>';
      
      }



    }
?>
</ul>
    </div>
    </div>
   
    <script type="text/javascript">
    $(document).ready(function(){

$('.form-check-input').on('click',function(){
    $('.deleteButton').slideDown(200);
 }) ;

 
}) ;
       function validateForm(type){
         //  var optradio = document.forms["myForm"]["optradio[]"].value;
           var array = [];
var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
 
for (var i = 0; i < checkboxes.length; i++) {
 array.push(checkboxes[i].value);
}
$.post('deleteEdit.php', {
                        'type': type,
                        'id': array
                }, function(data){
                   //ResultDelete
                   document.getElementById('ResultDelete').innerHTML = data;
                     location.reload() ;
                })
  // console.log(array);
         //  console.log(optradio[0]);
         //console.log('hahaha');
           return (false);
       }
       </script> 
    

</body>
</html>
