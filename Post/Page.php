<?php
 session_start();
 if(!empty($_POST)){
     if(isset($_POST['page'])){
         $page = $_POST['page'];
       //  echo $page; die();
     }
 }



?>
<?php
      if(isset($_SESSION['alern']) && $_SESSION['alern'] == true){
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Thành Công!</strong> Bạn đã đặt hàng thành công.
       <br/> <a href="index.php"><button style="margin-top: 12px" type="button" class="btn btn-success">Tiếp tục mua hàng</button></a>
      </div>';
         unset($_SESSION['alern']);
      }
    
    ?>
     <?php
     require_once ('./Help.php');
     $sql = 'SELECT * FROM nokia';
     $result = executeResult($sql);
      foreach ($result as $key => $value){
        if ($key == (4 * $page)){
          break ;
        }
     ?>
  <div class="Select-introduce">
         <center> <img src="<?=$value['image']?>" width="170" height="170"></center>
         <h4> <?=$value['name']?> </h4>
         <h6> <?=number_format($value['giacu'], 0, ",", ".")?>đ</h6>
         <h5> <?=number_format($value['giamoi'], 0, ",", ".")?>đ</h5>
         <center> <a href="product.php?id=<?=$value['id']?>"><button style="float:none !important" type="button" class="btn btn-success">Xem chi tiết</button></a></center>
         <center> <button onclick="AddCart(<?=$value['id']?>)" style="margin-top : 12px" type="button" class="btn btn-warning">Thêm Vào Giỏ Hàng</button></center>
     </div>
     <?php
      }
     ?>
       <div style="clear : both"></div>
       <?php if((count($result) - ($page * 4)) > 0) {?>
    <center> <a href="javascript:;"> <button onclick="ChangePage(<?= ($page + 1)?>)" style="color : blue !important ;
  margin : 40px ;" type="button" class="btn btn-outline-light text-dark">Xem Thêm <?php echo (count($result) - ($page * 4));?> Sản Phẩm</button> </a></center>
  <?php } ?>
 </div> 