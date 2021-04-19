
   <?php
   require_once ('./Help.php');
   if(!empty($_POST)){
    if(isset($_POST['id'])){
       $id = $_POST['id'];
       if(isset($_POST['page'])){
           $page = $_POST['page'];
          // echo $page; die();
          $offset = $page * 10;
       }
    //   $sql = 'SELECT * FROM `comment` WHERE `id_product` = '.$id.'';
   $sql = 'SELECT * FROM `comment` WHERE `id_product` = 308 AND `id_parent` = 0 LIMIT 10 OFFSET '.$offset.'';
  // var_dump($sql); die();
       $limitComment = 10 ;
       $result_data = executeResult($sql);
   
    //  var_dump($result_data); die();
       foreach($result_data as $key => $value){
         if($value['id_parent'] == 0){
          
          $name = $value['name_user_comment'];?>
  <div class="comment-parent">
        <div class="image-user-comment"> <b><?=$name[0]?></b></div>
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
  <br/> <a href="javascript:;" onclick="ShowCmtChildren(<?=$value['id']?>, 'dom', <?=$value['id']?>, <?=$id?>)">Trả lời - </a>
  <a style="margin-left :16px" href="javascript:;"> Hữu ích</a>
  <h8 style="margin-left:18px">- 12/02/2021</h8>
 
         <?php 
         $id_parent = $value['id'];
         $count = 0;
         $SqlSumresult = 'SELECT * FROM `comment` WHERE `id_product` = '.$id.' AND `id_parent` != 0';
         $Sumresult =  executeResult($SqlSumresult);
         foreach($Sumresult as $key1 => $value1){
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
  <br/> <a href="javascript:;" onclick="ShowCmtChildren(<?=$value1['id_parent']?>, 'dom', <?=$value['id']?>, <?=$id?>)">Trả lời - </a>
  <a style="margin-left :16px" href="javascript:;"> Hữu ích</a>
  <h8 style="margin-left:18px">- 12/02/2021</h8>
  </div>

<?php
                 $count ++;
             }
            
          }
          if ($count != 0){echo '</div>';}
         echo '<div id="'.$value['id'].'" class="ans-chil"></div>';
         
         
         ?>
  </div>
  
 <?php }
 }
}
}?>
<ul class="pagination">
<?php
  $QuanlityPage = 'SELECT * FROM `comment` WHERE `id_product` = 308 AND `id_parent` = 0';
  $ResultQltt = executeResult($QuanlityPage);
  $SumPageQtl = count($ResultQltt) / 10;
 // echo count($ResultQltt) . "<br/>";
  //echo $SumPageQtl;
 for ($i = 1; $i <= $SumPageQtl; $i ++){
      echo '<li class="page-item"><a class="page-link" onclick="Void('.$id.', '.$i.')" href="#changeCommentParent">'.$i.'</a></li>';
 }
?>
</ul>
  <form name="checkForm" action="" method="POST" onsubmit="return validateForm('UpdateParent', <?=$id?>, '-1')" >
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
