<?php
 require_once ('./Help.php');
   if(!empty($_POST)){
    if (!isset($_POST['vote'])){
         if(isset($_POST['id'])){
             $id = $_POST['id'];
         }
         if(isset($_POST['comment'])){
            $comment = $_POST['comment'];
        }
        if(isset($_POST['action'])){
            $action = $_POST['action'];
        }
        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }
       // echo $id."<br/>";
      
       // echo $comment. "<br/>";
       // echo $username. "<br/>";
        require_once ('./Help.php');
        if ((isset($_POST['action']) && $action == 'UpdateParent')){
            
        $sql = 'INSERT INTO comment (id_product, id_parent, content_comment, name_user_comment) VALUES ('.$id.', 0, "'.$comment.'", "'.$username.'") ';
//var_dump($sql) ; die();
             execute($sql);
    }
    if(isset($_POST['id_parent'])){
        $id_parent = $_POST['id_parent'];
        //echo $id_parent; die();
        $sql = 'INSERT INTO comment (id_product, id_parent, content_comment, name_user_comment) VALUES ('.$id.', '.$id_parent.', "'.$comment.'", "'.$username.'") ';
      //  var_dump($sql); die();
             execute($sql);
             //header('location:comment.php');
    }
  }
  if (isset($_POST['vote'])){
      $vote = $_POST['vote'];
      $id_product =  $_POST['id_product'];
      $NumberPhone = $_POST['NumberPhone'];
      $Email = $_POST['Email'];
      $Name = $_POST['Name'];
      $Note = $_POST['Note'];
      $sql = 'INSERT INTO comment (id_product, id_parent, content_comment, name_user_comment, vote, NumberPhone, Gmail) VALUES ('.$id_product.', 0, "'.$Note.'", "'.$Name.'",  "'.$vote.'", "'.$NumberPhone.'", "'.$Email.'") ';
      execute($sql);
   
    $sql = 'SELECT * FROM `voteproduct` WHERE `id_product` = '. $id_product.'';
    $result = executeSingleResult($sql);
    $TempCount = $result['QuanlityStar'.$vote.''];
    //echo   $TempCount;
    $TempCount ++;
    
            $sqlNumber = "UPDATE `voteproduct` SET `QuanlityStar$vote` = '$TempCount' WHERE `voteproduct`.`id_product` = $id_product";
            //var_dump($sqlNumber); die();
            execute($sqlNumber);
   
  }
   }
  




?>
<div style="clear : both"></div>
   <?php
   
   if(!empty($_POST)){
    if(isset($_POST['id']) || isset($_POST['vote'])){
      if (!isset($_POST['vote'])){
        $id = $_POST['id'];
      } else {
        $id = $id_product;
      }
       $sql = 'SELECT * FROM `comment` WHERE `id_product` = '.$id.'';
       $result = executeResult($sql);
       $result_data = ReturnDataComment($result, 0, 0);
       foreach($result_data as $key => $value){
         if (isset($_POST['routing'])){
             if ($value['vote'] != $_POST['routing']){
               continue;
             }
         }
         if($value['lever'] == 0){

          $name = $value['name_user_comment'];?>
  <div class="comment-parent">
        <div class="image-user-comment"> <b> <?=$name[0]?>  </b></div>
        <h6> <b> <?=$name?> </b></h6>
        <div style="clear : both"></div>
        <div class="roundStar">
        <?php
        if ($value['vote'] != null){
            //echo $value['vote'];
            
            for($i = 1; $i <= $value['vote']; $i ++){
      ?>
       
    <img src="https://i.pinimg.com/originals/79/0c/e5/790ce50a0d73665b9b657fc0dbb9c552.png" width="14" height="14">
    
  
  <?php }}
   
        ?>
        </div>
        <h7> <?=$value['content_comment']?> </h7>
  <br/> <a onclick="ShowCmtChildren(<?=$value['id']?>, 'dom', <?=$value['id']?>, <?=$id?>)" href="javascript:;">Trả lời - </a>
  <a style="margin-left :16px" href="javascript:;"> Hữu ích</a>
  <h8 style="margin-left:18px">- 12/02/2021</h8>
 
         <?php 
         $id_parent = $value['id'];
         $count = 0;
         foreach($result_data as $key1 => $value1){
            if ( $id_parent == $value1['id_parent']){
                  $name1 = $value1['name_user_comment'];
                if ($count == 0){ echo '  <div class="arrow-up"></div>';
                  echo '<div  class="comment-children">';}
          ?>
                   <div <?php if($count == 0) echo 'style="border-top : none"' ;?> class="user-comment">
     <div class="image-user-comment"> <b><?=$name1[0]?> </b></div>
    <h6> <b> <?=$name1?> </b></h6>
        <div style="clear : both"></div>
        <div class="roundStar">
        <?php
        if ($value1['vote'] != null){
            //echo $value['vote'];
            
            for($i = 1; $i <= $value1['vote']; $i ++){
      ?>
       
    <img src="https://i.pinimg.com/originals/79/0c/e5/790ce50a0d73665b9b657fc0dbb9c552.png" width="14" height="14">
    
  
  <?php }}
   
        ?>
        </div>
        <h7><?=$value1['content_comment']?></h7>
  <br/> <a onclick="ShowCmtChildren(<?=$value1['id_parent']?>, 'dom', <?=$value['id']?>, <?=$id?>)" href="javascript:;">Trả lời - </a>
  <a style="margin-left :16px" href="javascript:;"> Hữu ích</a>
  <h8 style="margin-left:18px">- 12/02/2021</h8>
  </div>

<?php
                 $count ++;
             }
            
          }
          if ($count != 0){echo '</div>';}
          if (isset($action) && $action == $value['id']){
        // echo '<div id="'.$value['id'].'" class="ans-chil"></div>';
        echo ' <div class="ans-chil">
        <form name="checkForm" action="" method="POST" onsubmit="return UploadCmt('.$id.', '.$value['id'].')" >
        <div class="form-group">
        <label >Nhập tên của bạn:</label>
        <br/><span id="error-name-1"> * Bắt buộc nhập </span>
        <input name="username" type="text" class="form-control" placeholder="Enter your name" >
        <br/><span id="error-comment-1"></span>
      </div>
        <div class="form-group">
        <textarea placeholder="Mời Bạn Để Lại Bình Luận ..." class="form-control" rows="5" id="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Gửi</button>
      </form>
      
        </div>';
          }
         
         ?>
  </div>
  
 <?php }
 }
}
}?>
<center><a href="product.php?id=<?=$id?>#contentAvote"> <button style="margin-top : 20px" type="button" class="btn btn-outline-primary">Xem tất cả đánh giá > </button></a> </center>
  <form name="checkForm" action="" method="POST" onsubmit="return validateForm('UpdateParent', <?=$id?>)" >
  <div class="form-group">
    <label >Nhập tên của bạn:</label>
    <br/><span id="error-name"> * Bắt buộc nhập </span>
    <input name="username" type="text" class="form-control" placeholder="Enter your name" >
    <br/><span id="error-comment"></span>
  </div>
  <div class="form-group">
  <textarea name="comment" placeholder="Mời Bạn Để Lại Bình Luận ..." class="form-control" rows="5" id="comment"></textarea>
</div>
<button  type="submit" class="btn btn-primary">Gửi</button>
</form>


