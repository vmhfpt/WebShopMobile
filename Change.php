
<?php
ob_start();
  session_start();
  if(!isset($_SESSION['login'])){
      header("location:login.php") ;
  }
  require_once ('../Dbhelp/dbhelp.php') ;
  $Name_admin = $_SESSION['login']['printf_name'];
  $username = $password = null ;
  $login = false ;
  if (!empty($_POST)){
    if (isset($_POST['username'])){
      $username = $_POST['username'];
    }
    if (isset($_POST['password'])){
        $password = MD5($_POST['password']);
    }
    if (isset($_POST['printf_name'])){
       $printf_name = $_POST['printf_name'];
      // echo $printf_name ; die();
    }
    $sql = 'SELECT * FROM sinhvien WHERE username = "'.$username.'" AND password = "'.$password.'"'; 
    $result = executeSingleResult($sql);
    $login = true ;
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .body-content span {
  position : relative ;
  top : -13px ;
  
  color : red ;
  font-size : 15px ;
}

.login-error {
  font-size : 18px ;
  color : #000000 !important;

   margin : 12px 0px 12px 18% ;
   height : 80px ;
   background : #FF8b8A ;
   width : 65% ;
   border-radius : 6px ;
}
.login-error p {
    padding : 13px ;
  text-align : center ;
}
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
        height : 1290px ;
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
      @media only screen and (min-width: 768px) {
        .change-accround {
        //background : orange !important;
        max-width : 690px !important;
        }
        .login-error p {
    padding : 25px !important;
  text-align : center ;
}
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
        <a class="nav-link" href="change.php">Thay Đổi Thông Tin</a>
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
      <img class="image-nav" src="https://lh3.googleusercontent.com/proxy/zdvLrdB_c9Ed3HQHkuEyqm0OpNEf3MTQQ3GeuIEK2t7PPFwvkeZgbUrP3c4YNuBey8fLWogLKqQ-ZpgdCwUeGh1Or3_r5E3kU6ot3TtmnxtPgct11aaAktmeK5Qlx07f" width="40" height="40">
        <a class="nav-link" href="#">Tin Tức</a>
      </li>  
      <li class="nav-item">
      <img class="image-nav" src="https://lh3.googleusercontent.com/proxy/GpZN-c2R6CqjHp5Kw5hN6PLy7C5K9cOhYy6g8GMQEcG-sjFUeHknpxy2Tr_bmAF3QUOdg-K_k6LNtLIv7yNQnFPajNZjwyx-KUCs1EmI_CKQBw" width="40" height="40">
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
      <h1> Thay Đổi Thông Tin</h1>
      <div class="container">
     <div class="col change-accround">
     <form action="" method="POST" name="myForm"  onsubmit="return validateForm()">
    <div id = "username" class="form-group">
     <lable> Tên đăng nhập : </lable>
      <input value="<?php
      if (isset($_SESSION['login'])){
          echo $_SESSION['login']['username'];
      }
      
      ?>" autocomplete = "off" type="text" class="form-control" id="email" placeholder="Enter Username" name="username">
    </div>
   
    <span id ="erro1">* Bắt buộc nhập </span>
    <div class="form-group">
    <lable> Tên hiện thị : </lable>
        <input value="<?=$_SESSION['login']['printf_name']?>" autocomplete = "off" type="text" class="form-control" placeholder="Enter Name" name="printf_name">
    </div>
    <span id="erro6"> * Bắt buộc nhập</span>
    <div style = "clear : both"> </div>
    <div id = "password" class="form-group">
    <lable> Mật khẩu </lable>
      <input type="password" class="form-control" id="pwd" placeholder="Enter Pasword" name="password">
    </div>
    <div style = "clear : both"> </div>
    <span id = "erro2">* Bắt buộc nhập </span>
    <div style = "clear : both"> </div>
    <div id = "password-new" class="form-group">
    <lable> Mật khẩu mới : </lable>
      <input type="password" class="form-control" id="pwd-new" placeholder="Enter New Pasword" name="new_password">
    </div>
    <div style = "clear : both"> </div>
    <span id = "erro4">* Bắt buộc nhập </span>
    <div style = "clear : both"> </div>
    <div id = "password-repeat" class="form-group">
    <lable> Nhập lại mật khẩu : </lable>
      <input type="password" class="form-control" id="pwd-repeat" placeholder="Enter Repeat Password " name="repeat_password">
    </div>
    <div style = "clear : both"> </div>
    <span id = "erro5">* Bắt buộc nhập </span>
    <div class="form-group form-check">
    </div>
   
    <?php 
  if (isset($result) && $result != null && count($result) > 0){
     if (!empty($_POST)){
          if (isset($_POST['new_password'])){
              $id = $_SESSION['login']['id'] ;
               $change_password = MD5($_POST['new_password']) ;
               $_SESSION['login']['printf_name'] = $printf_name ;
             //  echo $printf_name; die();
            // $sql = 'UPDATE nokia SET name = "'.$name.'", content = "'.$content.'", image = "'.$image.'", giacu = "'. $giacu.'", giamoi = "'.$giamoi.'" WHERE id = '.$id ;
             $sql = 'UPDATE sinhvien SET printf_name = "'.$printf_name.'", password = "'.$change_password.'" WHERE id = '.$id ;
              execute($sql);
              header('location: index.php');
          } 
      }
} else if ($login == true){
   
  echo '<div  class = "login-error" id = "erro3"><p> Tài khoản hoặc mật khẩu không chính xác </p> </div> ' ;
} 
ob_end_flush();
?>
 <button type="submit" class="btn btn-danger">Xác Nhận</button>
  </form>
     </div> 
    </div>
    <script>
      
   function validateForm() {
    var test=0 ;
var name = document.forms["myForm"]["username"].value;
var pass = document.forms["myForm"]["password"].value;
var new_pass = document.forms["myForm"]["new_password"].value;
var repeat_pass = document.forms["myForm"]["repeat_password"].value;
 var str = new String(name) ;
 var str1 = new String(pass) ;
 var str2 = new String(new_pass);
 var str3 = new String(repeat_pass);
 var error_password = error_username = '' ;
//console.log(str.length) ;
  function test_character1(str, error_username){
    var text = false, number = false ;
    for (var i = 0; i < str.length; i ++){
        if ((str.charCodeAt(i) > 96  && str.charCodeAt(i) < 123 ) || (str.charCodeAt(i) > 64 && str.charCodeAt(i) < 91)){
           text = true ;
           continue ;
        } 
        if ((str.charCodeAt(i) > 48 && str.charCodeAt(i) < 58)){
            number = true ;
            continue ;
        }
    }
      if (text != true || number != true){
           error_username = 'Tên đăng nhập phải chứa chữ cái và số' ;
      } else {
           error_username = '' ;
      }
    return (error_username) ;
}
  function test_character2(str, error_username){
     for (var i = 0; i < str.length; i ++){
        if ((str.charCodeAt(i) > 96  && str.charCodeAt(i) < 123 ) || (str.charCodeAt(i) > 64 && str.charCodeAt(i) < 91) || (str.charCodeAt(i) > 47 && str.charCodeAt(i) < 58)){
             error_username = '' ;
        } else {
        error_username = 'Tên đăng nhập không được chứa ký tự đặc biệt' ;
        break ;
        }
     }
  return (error_username) ;
}
  function test_length(str, error_username){
        if (str.length < 6 || str.length > 11) {
            error_username = 'Tên đăng nhập phải lớn hơn 6 ký tự và nhỏ hơn 12 ký tự' ;
        } 
        if (str == ''){
          error_username = 'Không được để trống';
        }
   return (error_username) ;
}
function test_character22(str, error_password){
     for (var i = 0; i < str.length; i ++){
        if ((str.charCodeAt(i) > 96  && str.charCodeAt(i) < 123 ) || (str.charCodeAt(i) > 64 && str.charCodeAt(i) < 91) || (str.charCodeAt(i) > 47 && str.charCodeAt(i) < 58)){
            error_password = '' ;
        } else {
            error_password = 'Mật khẩu không được chứa ký tự đặc biệt' ;
            //console.log(str[i]);
        break ;
        }
     }
  return (error_password) ;
}
  function test_length2(str, error_password){
        if (str.length < 6 || str.length > 11) {
            error_password = 'Mật khẩu phải lớn hơn 5 ký tự và nhỏ hơn 12 ký tự' ;
        }
        if (str == ''){
          error_password = 'Không được để trống';
        }
   return (error_password) ;
}
 function Test_Password_change(str1, str2, error_password){
     if (str1 != str2 || (str1 == '' && str2 == '')){
        error_password = 'Mật khẩu nhập lại không khớp';
        return (error_password) ;
     }
     return (error_password) ;
 }
  var testError, Username_Error = '', PassWord_Error = '', PassWord_Error_Repeat = '', PassWord_Error_New = '', PassWord_Change = '';
  testError = test_character1(str, error_username)
  if (testError != ''){
    Username_Error = testError ;
  }
  testError = test_character2(str, error_username) ;
  if (testError != ''){
    Username_Error = testError ;
  }
  testError = test_length(str, error_username) ;
  if (testError != ''){
    Username_Error = testError ;
  }
 //console.log(textError) ;
 testError = test_character22(str1, error_password) ;
  if (testError != ''){
    PassWord_Error = testError ;
  }
  testError = test_length2(str1, error_password) ;
  if (testError != ''){
    PassWord_Error = testError ;
  }
  testError = test_character22(str2, error_password) ;
  if (testError != ''){
    PassWord_Error_New = testError ;
  }
  testError = test_length2(str2, error_password) ;
  if (testError != ''){
    PassWord_Error_New = testError ;
  }
  testError = test_character22(str3, error_password) ;
  if (testError != ''){
    PassWord_Error_Repeat = testError ;
  }
  testError = test_length2(str3, error_password) ;
  if (testError != ''){
    PassWord_Error_Repeat = testError ;
  }
  testError = Test_Password_change(new_pass, repeat_pass, error_password);
  if (testError != ''){
    PassWord_Change = testError ;
  }
   if (Username_Error != '' || PassWord_Error != '' || PassWord_Error_New != '' || PassWord_Error_Repeat != '' || PassWord_Change != ''){
      document.getElementById("erro1").innerHTML = Username_Error ;
      document.getElementById("erro2").innerHTML = PassWord_Error ;
      document.getElementById("erro4").innerHTML = PassWord_Error_New ;
      document.getElementById("erro5").innerHTML = PassWord_Error_Repeat ;
      $('#erro3').css('display','none');
      if (Username_Error != ''){
        $('#username').css('border-bottom','2px solid red');
        $('#email').css('background','#ff050550');
      } else {
        $('#username').css('border-bottom','2px solid #004BFF');
        $('#email').css('background','#05ff3b4b');
      }
      if (PassWord_Error != ''){
        $('#password').css('border-bottom','2px solid red');
        $('#pwd').css('background','#ff050550');
      } else {
        $('#password').css('border-bottom','2px solid #004BFF');
        $('#pwd').css('background','#05ff3b4b');
      }
      if (PassWord_Error_New != ''){
        $('#password-new').css('border-bottom','2px solid red');
        $('#pwd-new').css('background','#ff050550');
      } else {
        $('#password-new').css('border-bottom','2px solid #004BFF');
        $('#pwd-new').css('background','#05ff3b4b');
      }
      if (PassWord_Error_Repeat != ''){
        $('#password-repeat').css('border-bottom','2px solid red');
        $('#pwd-repeat').css('background','#ff050550');
      } else {
        $('#password-new').css('border-bottom','2px solid #004BFF');
        $('#pwd-repeat').css('background','#05ff3b4b');
      }
      if (PassWord_Change != '') {
        document.getElementById("erro5").innerHTML = PassWord_Change ;
        $('#erro3').css('display','none');
        $('#password-repeat').css('border-bottom','2px solid red');
        $('#pwd-repeat').css('background','#ff050550');
      } else {
        $('#password-repeat').css('border-bottom','2px solid #004BFF');
        $('#pwd-repeat').css('background','#05ff3b4b');
      }
      return (false) ;
   }
}
   </script>
    </div>
    </div>

</body>
</html>
