<?php
 session_start();
 ob_start();
         require_once ('./Help.php') ;
         $username = $password = null ;
         $login = false ;
         $check = false ;
         if (!empty($_POST)){
           if (isset($_POST['username'])){
             $username = $_POST['username'];
           }
           if (isset($_POST['password'])){
            $password = $_POST['password'] ;

           }
          if (isset($_POST['remember']) && $_POST['remember'] == 1){
           setcookie("pass", $password);
           setcookie("name", $username);
            $check = true ;
          } else {
            setcookie("pass", null);
            setcookie("name", null);
            $check = false ;
          } 
           $sql = 'SELECT * FROM accrount WHERE namelogin = "'.$username.'" AND password = "'.$password.'"'; 
           //var_dump($sql);die();
           $result = executeSingleResult($sql);
           $login = true ;
         }
         if (isset($_COOKIE['name']) && isset($_COOKIE['pass'])){
                $username = $_COOKIE['name'];
                $password = $_COOKIE['pass'];
                $check = true ;
         }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
 @media only screen and (max-width: 765px) {
  .wp-content{
   // height : 1000px !important;
  }
  #text {
  display : block !important;
}
   .login-for h1 {
     display : none ;
   }
  #email,#pwd {
    position : relative ;
       left : 35px ;
   }
        .form-group img {
          position : relative ;
          top : 35px ;
        }
    }
    @media only screen and (min-width: 992px) {
        .wp-content {
    font-family : 'Times New Roman', Times, serif ;
    background-image  : url('https://img.topthuthuat.net/wp-content/uploads/2019/11/30214859/31.jpg') !important;
    background-size: 100% 100%;
    background-repeat: none;
    height : 100vh ;
}
    }
    @media only screen and (min-width: 1140px) {
        .wp-content {
    font-family : 'Times New Roman', Times, serif ;
    background-image  : url('https://i.pinimg.com/originals/a2/43/88/a24388278b740dc1cc131e9cd58e1f0a.jpg') !important;
    background-size: 100% 100%;
    background-repeat: none;
    height : 100vh ;
}
        
    }
    @media only screen and (min-width: 1200px) {
        .wp-content {
    font-family : 'Times New Roman', Times, serif ;
    background-image  : url('https://hinhanhdep.net/wp-content/uploads/2018/03/hinh-nen-window-7-dep-full-hd-cho-pc-laptop-45.jpg') !important;
    background-size: 100% 100%;
    background-repeat: none;
    height : 100vh ;
}
        
    }
.form-group input {
    background : none ;
    border : none !important;
    outline: none !important;
    color : white !important;
}
.form-group input:hover {
    background : none ;
    border : none !important;
    outline : 0 ;
    color : white ;
}
input[type=text]:focus {
  background : none ;
  border: none !important;
  outline: none !important;
}
input[type=password]:focus {
  background : none ;
  border: none !important;
  outline: none !important;
}
input:focus, input.form-control:focus {
 box-shadow: none;
}
::placeholder { /* chạy tốt trên Chrome, Firefox, Opera, Safari 10.1+ */
   color: white !important;
}
.form-control {
   width : 91% !important;
}
.wp-content {
    font-family : 'Times New Roman', Times, serif ;
    background-image  : url('https://i.pinimg.com/736x/3e/b1/6c/3eb16c07ff522972843e954a019ad09e.jpg') ;
    background-size: 100% 100%;
    background-repeat: none;
    height : 100vh ;
}
.form-group {
    width : 65% ;
    margin-left : 18% ;
}
.form-h2 {
   text-align : center;
  padding-top : 15% ;
  padding-bottom : 30px ;
   color : rgb(255, 254, 254) ;
   font-size : 40px ;
}
.form-group {
    border-bottom: 2px solid #DDDDDD ;
    margin-top :2px ;
}
.image-form {
    float : left ;
    padding-top : 0px ;
    margin-right : 5px ;
  }
.form-check {
  color:#0515ff;
  border-bottom  : none !important;
}
.btn {
  box-shadow: none;
  margin-left : 18% ;
  width : 65% ;
}
span {
  position : relative ;
  top : -13px ;
  margin-left : 18% ;
  color : red ;
  font-size : 15px ;
}
#erro3 {
  color : red ;
  margin-left : 18% ;
}
.login-error {
  font-size : 18px ;
  color : #000000 !important;
  padding-top : 25px ;
  text-align : center ;
   margin : 12px 0px 12px 18% ;
   height : 80px ;
   background : #FF8b8A ;
   width : 65% ;
   border-radius : 6px ;
}
.or {
   margin : 38px 0px 38px 0px;
  text-align : center;
  border-radius : 100% ;
  width : 30px ;
  height : 30px ;
  background :#ec0d0d ;
  color : white ;
}
.facebook {
  float : left ;
width : 30%;
height : 35px ;
//background : #1153ce ;
background : blue ;
margin-left : 18% ;
border-radius : 3px ;
}
.email {
  border-radius : 3px ;
  float : right ;
width : 30%;
height : 35px ;
background :  #d60c0c ;
margin-right : 18% ;
}
.login_for img {
  float : left ;
}
.login-for h1 {
  color : white ;
  font-size : 16px ;
  margin-top : 6px;
  margin-left : 38px ;
  position : relative ;
  top : -34px ;
 
}
#text {
  display : none ;
}
</style>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class = "wp-content">
<div class="container">
  <h2 class = "form-h2">Đăng Nhập</h2>
  <form action="" method="POST" name="myForm"  onsubmit="return validateForm()">
    <div id = "username" class="form-group">
      <img class = "image-form" src = "https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/129-512.png" width = "35" height = "35">
      <input value = "<?php if( isset($_COOKIE['name'])){
        echo $username ;
      } else {
        echo $username ;
      }
      ?>" autocomplete = "off" type="text" class="form-control" id="email" placeholder="Enter Username" name="username">
    </div>
    <span id ="erro1">* Bắt buộc nhập </span>
    <div style = "clear : both"> </div>
    <div id = "password" class="form-group">
    <img class = "image-form" src = "https://capitalise.com/public/lock_icon_for-blog.png" width = "35" height = "35">
      <input value = "<?php if( isset($_COOKIE['pass'])){
        echo $password ;
      } else {
        echo $password ;
      }
      ?>" type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <div style = "clear : both"> </div>
    <span id = "erro2">* Bắt buộc nhập </span>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input"<?php echo ($check)?"checked":""?>  type="checkbox" name="remember" value = "1"> Remember me
      </label>
    </div>
<?php 
  if (isset($result) && $result != null && count($result) > 0){
    $_SESSION['order'] = $result;
    unset($_SESSION['cart']);
   // var_dump ($result) ; die();
    //var_dump(  $_SESSION['login']) ;
   // die() ;
    header('location: index.php');
} else if ($login == true){
  echo '<div  class = "login-error" id = "erro3">Tài khoản hoặc mật khẩu không chính xác </div> ' ;
} 
ob_end_flush();
?>
    <button type="submit" class="btn btn-danger">Đăng nhập</button>
  </form>

   
   <p style="color : white;
   font-size : 20px ;
   text-align : center;
   margin-top : 200px">© 2021 Form Login.All rights reserved | Design by Vu Minh Hung </p>
</div>
</div>
<script>
   function validateForm() {
    var test=0 ;
var name = document.forms["myForm"]["username"].value;
var pass = document.forms["myForm"]["password"].value;
 var str = new String(name) ;
 var str1 = new String(pass) ;
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
        if (str.length < 6 || str.length > 26) {
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
        if (str.length < 6 || str.length > 18) {
            error_password = 'Mật khẩu phải lớn hơn 5 ký tự và nhỏ hơn 18 ký tự' ;
        }
        if (str == ''){
          error_password = 'Không được để trống';
        }
   return (error_password) ;
}
 function Text_Security(str, error_password){
        if (str.length >= 6 ) {
            error_password = 'Mật khẩu Yếu' ;
        }
        if (str.length >= 9 ) {
            error_password = 'Mật khẩu Bình Thường' ;
        }
        if (str.length >= 13  ) {
            error_password = 'Mật khẩu Mạnh' ;
        }
   return (error_password) ;
 }
  var testError, Username_Error = '', PassWord_Error = '';
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
   if (Username_Error != '' || PassWord_Error != ''){
      document.getElementById("erro1").innerHTML = Username_Error ;
      document.getElementById("erro2").innerHTML = PassWord_Error ;
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
      var security = Text_Security(str1, '');
    if (security == 'Mật khẩu Yếu'){
      $('#pwd').css('background','#ff050550');
      document.getElementById("erro2").innerHTML = security ;
    } 
    if (security == 'Mật khẩu Bình Thường'){
      $('#pwd').css('background','#ddc80aa2');
      document.getElementById("erro2").innerHTML = security ;
    } 
    if (security == 'Mật khẩu Mạnh'){
      $('#pwd').css('background','#2ddd0aa2');
      document.getElementById("erro2").innerHTML = security ;
    } 
      return (false) ;
   }
}
   </script>
</body>
</html>