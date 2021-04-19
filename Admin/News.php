<?php
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('./Help.php') ;
  $sql = 'SELECT * FROM news';
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
 
    <div class="body-content">
    <div  style = "display : none;
    position : fixed;
margin-top : 50px;
z-index : 1000 ;" class="alert alert-success"> 
    <strong>Thành công!</strong> <span id = "alert-text"></span>
  </div>
      <h1> Danh Sách Tin Tức </h1>
    <a href="EditNews.php"> <button type="button" class="btn btn-success">Thêm Tin Tức</button> </a>
    
    <div class="search-product">
       <form method="GET" action="">
           <center><h5> Tìm Kiếm Tin Tức</h5></center>
           <input value="<?= $search_id?>" name="search_id" type="number" class="form-control" placeholder="Enter Your Key Search Date News" id="id_seach">
           <input value="<?=$_SESSION['Search_name']?>" name="search_name" type="text" class="form-control" placeholder="Enter Your Key Search Name Title News" id="name_searche">
            <div style="clear : both"></div>
            <span> <?=$Search_Error?></span><br/>
           <button type="submit" class="btn btn-dark">Tìm Kiếm</button>
          
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
        <th>Ảnh Đại Diện</th>
        <th>Tiêu đề tin</th>
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
           $sql = 'SELECT * FROM news LIMIT '. $limit .' OFFSET '. $index .'';
     } else {
         if(isset($_GET['search_name']) && $_GET['search_name'] != '' || $_SESSION['Search_name'] != null) {
              $sql = 'SELECT * FROM news WHERE name like "%'.$_SESSION['Search_name'].'%" LIMIT '. $limit .' OFFSET '. $index .'';
         }
         if(isset($_GET['search_id']) && $_GET['search_id'] != '' && $_SESSION['Search_name'] == null)  {
             $sql = 'SELECT * FROM news WHERE id = ' . $_GET['search_id'] ;
         }
     }
         $result = executeResult($sql) ;
      if (count($result) > 0) {
          foreach ($result as $key) {
      ?>
      <tr>
      <td> <?=$key['id']?></td>
        <td><img src="<?=$key['image']?>" width="80" height="80"/></td>
        <td><?=$key['title']?></td>
        <td><center><a href="EditNews.php?id=<?=$key['id']?>&takes=copy"><button type="button" class="btn btn-primary">Copy</button> </a></center></td>
        <td> <center><a href="EditNews.php?id=<?=$key['id']?>"><button type="button" class="btn btn-warning">Sửa</button> </a> </center></td>
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
