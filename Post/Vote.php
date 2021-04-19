<?php
 require_once ('./Help.php');
  $sql = 'SELECT * FROM `voteproduct` WHERE `id` = 1 ';
  $result = executeSingleResult($sql);
  $countVote = 0;$test = 0;
  $TBCStar = 0;$Star = 1;
     foreach($result as $key){
         if( $test < 2){
             $test ++;
             continue ;
         }
         //echo  $key. "   ";
         $TBCStar =  $TBCStar + ($Star * $key); 
         $Star ++;
         $countVote = $countVote +  $key;
     }
    // echo $countVote;
    ///echo  ($TBCStar/$countVote);
//  die();
$totalStar = round($TBCStar/$countVote, 1);
//echo $totalStar;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
  <title>Document</title>
  <style>
      .round-vote{
          float : left;
      }
     
      .Vote-Result {
       
          margin : 30px ;
         float : left;
          
          width: 50%;
      }
      .progress {
          float : left;
          margin : 10px 0px 0px 12px ;
      }
      .voteCartA {
        float : left ;
        margin-left : 15px;
      }
      .roundSum {
          font-size : 50px;
      }
      .SumStar {
          margin-top : 40px;
          border-right : 1px solid #000000;
          width : 140px;
          padding-bottom : 20px;
       float : left;
      }
      #block {
        display : none ;
     
    
      }
      #hident {
        position : relative ;
      
      }
      .YourVote{
        margin-top : 15px;
        float :left;
        position: relative;
        left : -150px;
      }
      div.stars {
  width: 270px;
  display: inline-block;
}
 
input.star { display: none; }
 
label.star {
  float: right;
  padding: 10px;
  font-size: 24px;
  color: #444;
  transition: all .2s;
}
 
input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
 

 

 

 
label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
.stars {
  display : none ;
 top : -40px;
  position: relative;
 left : -35px;
  
}
#HidenVote {
  display: none;
 margin-top: 15px;
}
.FormInput {
  display: none;
  margin-top : 50px;
  
  width : 800px ;
  
  position: relative;
 left : -150px;
  
}
.FormInput .form-group {
  margin  : 4px ;
}
  </style>
</head>
<body>
<div class="container">
    <div>
    <div class="SumStar">
    <div class="roundSum">
    <span style="position : relative;top : 6px"> <?=$totalStar?></span>
    <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="45" height="45">
    </div>

    </div>
  <div class="Vote-Result">
    <?php
    $test = 0;
    $i = 1;
      foreach($result as $key){
         
        if( $test < 2){
            $test ++;
            continue ;
        }
        
    ?>
     <div class="round-vote">
    <span> <?=$i?> <img src="http://simpleicon.com/wp-content/uploads/star.png" width="17" height="17"></span>
    </div>
    <div class="progress" style="height:5px; width : 30%">
    <div class="progress-bar bg-warning" style="width:<?=(100/$countVote) * $key?>%;height:5px"></div>
    
  </div>
  <div class="voteCartA">
  <a  href=""> <?=$key?> Đánh giá</a>
  </div>
  <div style="clear:both"></div>
   <?php $i ++;}?>
   <div class="YourVote">
<a id="hident" href="javascript:hident();"> <button type="button" class="btn btn-primary">Gửi đánh giá của bạn </button></a>
<a id="block" href="javascript:closeNone();"> <button type="button" class="btn btn-light">Đóng lại</button> </a>
</div>
<div style="clear: both"></div>
<div id="HidenVote">
<span style="float : left;
position: relative;
 left : -140px;"> Chọn đánh giá của bạn</span>
 <span style="margin-left : 75px" id="temp"> </span> <br/>
<div class="stars">

    <form  name="checkFormVote" action="" method="POST" onsubmit="return validateFormVote()" >
 
    <input  class="star star-5" value="5" id="star-5" type="radio" name="star"/>
    <label class="star star-5"    for="star-5"></label>
    <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
    <label class="star star-1" for="star-1"></label>
    <span id="temp"> </span> <br/>
    <div class="FormInput"> 
    <div style="float : left;
    width : 360px;
    " class="form-group">
  <textarea  class="form-control" placeholder="Nhập đánh giá về sản phẩm (tối thiểu 80 ký tự)" rows="5" id="comment" name="note"></textarea>
</div>
    <div style="float : left;
    width : 180px" class="form-group">
    <input name="name" type="text" class="form-control" placeholder="Họ tên" >
  </div> 
 
  <div style="float : left;
    width : 180px" class="form-group">
    <input name="numberphone" type="number" class="form-control" placeholder="Số điện thoại" >
  </div>
 
  <div style="float : left;
    width : 180px" class="form-group">
    <input name="email" type="email" class="form-control" placeholder="Email" >
  </div>
  <button style=" width : 180px; margin : 5px"type="submit" class="btn btn-primary">GỬI ĐÁNH GIÁ</button>
  <div style="clear : both"></div>
  <span style="color : red"> * Vui lòng nhập đầy đủ các trường</span>
  </div>
  
  </form>

</div>
</div>
<!--  <div class="round-vote">
    <span> 1 <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="20" height="20"></span>
    </div>
    <div class="progress" style="height:7px; width : 30%">
    <div class="progress-bar bg-warning" style="width:60%;height:7px"></div>
    
  </div>
  <div class="voteCartA">
  <a  href=""> 135 Đánh giá</a>
  </div>
  <div style="clear:both"></div>
  <div class="round-vote">
    <span> 2 <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="20" height="20"></span>
    </div>
    <div class="progress" style="height:7px; width : 30%">
    <div class="progress-bar bg-warning" style="width:60%;height:7px"></div>
  </div>
  <div style="clear:both"></div>
  <div class="round-vote">
    <span> 3 <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="20" height="20"></span>
    </div>
    <div class="progress" style="height:7px; width : 30%">
    <div class="progress-bar bg-warning" style="width:60%;height:7px"></div>
  </div>
  <div style="clear:both"></div>
  <div class="round-vote">
    <span> 4 <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="20" height="20"></span>
    </div>
    <div class="progress" style="height:7px; width : 30%">
    <div class="progress-bar bg-warning" style="width:60%;height:7px"></div>
  </div>
  <div style="clear:both"></div>
  <div class="round-vote">
    <span> 5 <img src="https://cdn3.iconfinder.com/data/icons/basicolor-votting-awards/24/198_star_favorite_vote_achievement-512.png" width="20" height="20"></span>
    </div>
    <div class="progress" style="height:7px; width : 30%">
    <div class="progress-bar bg-warning" style="width:60%;height:7px"></div>
  </div> -->
</div>

</div>
   
      </div>
<script type="text/javascript">
 function validateFormVote(){
    var vote = document.forms["checkFormVote"]["star"].value;
    var NumberPhone = document.forms["checkFormVote"]["numberphone"].value;
    var Name = document.forms["checkFormVote"]["name"].value;
    var Email = document.forms["checkFormVote"]["email"].value;
    var Note = document.forms["checkFormVote"]["note"].value;
    console.log(vote);
    console.log(NumberPhone);
    console.log(Name);
    console.log(Email);
    console.log(Note);
    //console.log('hahah');
     return (false);
  }
 $(document).ready(function(){
  
$('#star-5').on('click',function(){
  document.getElementById("temp").innerHTML = 'Rất Tốt'; 
 }) ;
 $('#star-4').on('click',function(){
  document.getElementById("temp").innerHTML = 'Tốt'; 
 }) ;
 $('#star-3').on('click',function(){
  document.getElementById("temp").innerHTML = 'Bình thường'; 
 }) ;
 $('#star-2').on('click',function(){
  document.getElementById("temp").innerHTML = 'Tệ'; 
 }) ;
 $('#star-1').on('click',function(){
  document.getElementById("temp").innerHTML = 'Rất tệ'; 
 }) ;
$('.star').on('click',function(){
  $('.FormInput').fadeIn(5);
 }) ;
}) ;
 function hident(){
  $('#block').fadeIn(5);
  $('#hident').fadeOut(5);
  $('#HidenVote').fadeIn(5);
  //HidenVote
  //console.log('hshshshhs');
 }
 function closeNone(){
  $('#hident').fadeIn(5);
  $('#block').fadeOut(5);
  $('#HidenVote').fadeOut(5);
 }
      </script>
</body>
</html>