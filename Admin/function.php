<?php
function createMenuTree($menuList, $parent_id, $lever){
  $menuTree = array();
  foreach($menuList as $key => $menu){
    if($menu['parent_id'] == $parent_id){
       $menu['lever'] = $lever;
       $menuTree[] = $menu;
     unset($menuList[$key]);
       $children = createMenuTree($menuList, $menu['id'], $lever + 1);
       $menuTree = array_merge($menuTree, $children);
    }
  }
  return ($menuTree);
}

 function validateUploadFile($file, $uploadPath) {
  //return(true);
   $Test_Valid = false ;
     // Kiểm tra xem file có vượt quá mức dung lượng cho phép không !!!
     if ($file['size'] > 4.5 * 1024 * 1024) { // 2Mb = 2 * 1024kb * 1024 bite
      // echo $file['size'] . "<br/>"; die(); 
         return (0);
     }
    // Kiểm tra file có đúng hợp lệ không
     $validTypes = array('jpg', 'jpeg', 'png', 'bmp');
     $fileType = substr($file['name'], strrpos($file['name'], ".") + 1) ;
     // if (!in_array($fileType, $validTypes)) {
      //   return false ;
  //   }
      for ($i = 0; $i < count($validTypes); $i ++){
           if ($fileType == $validTypes[$i]){
                $Test_Valid = true ;
                break ;
           } else {
               continue ;
           }
      }
      if ($Test_Valid == false){
        return (1) ;
      }
      // kiểm tra file tồn tại hay chưa,nếu đã tồn tại => đổi tên file đó
      $Num = 1;
      $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
      while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
        $fileName =  $fileName . "(". $Num .")";
        $Num ++;
      }
      $file['name'] = $fileName . '.' . $fileType;
      return ($file);
 }
     /* function uploadFiles($uploadedFiles){
          $files = array();
          $errors = array();
          foreach ($uploadedFiles as $key => $values) {
            foreach ($values as $index => $value) {
                $files[$index][$key] = $value ;
            }
         }
         $uploadPath = "../uploads/" . date('d-m-Y', time());
          if (!is_dir($uploadPath)) {
               mkdir($uploadPath, 0777, true);
         } 
          foreach ($files as $file){
            $file_temp = $file;
            $file = validateUploadFile($file, $uploadPath);
            if ($file != false) {
               move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"]);
               $errors[] = $uploadPath . '/' . $file["name"] ;
            } else {
              $errors[] = false ;
            } 
        }
        return ($errors);   
      } */
      function upLoadFiles($uploadedFiles){
        $count = 1;
        $files = array();
        $error = array();
          foreach ($uploadedFiles as $key => $values){
             $count = count($values);
          }
         if($count == 1){
            // Sử lí với một file
           // var_dump($uploadedFiles);
            foreach ($uploadedFiles as $key => $values){
                 foreach ($values as $index => $value){
                      $files[$index][$key]= $value;
                 }
            }
            $uploadPath = "../uploads/" . date('d-m-Y', time());
            if (!is_dir($uploadPath)){
                 mkdir($uploadPath, 0777, true);
            }
            $Remember_name = $files[0]['name'];
            $files[0] = validateUploadFile($files[0], $uploadPath);
           
            if ($files[0] == 0 || $files[0] == 1){
              if ($files[0] == 0) {
                 $error[] = '*File ' .$Remember_name. ' Vượt quá 4.5Mb';
              } else if ($files[0] == 1){
                $error[] = '*File ' . $Remember_name. ' không đúng với định dạng hình ảnh';
              }
              $error[] = true;
            } else {
              $error[] = $uploadPath . '/' . $files[0]["name"] ;
             // echo $error[0]; die();
              move_uploaded_file($files[0]["tmp_name"], $uploadPath . '/' . $files[0]["name"]);
            }
         
           return ($error);
         } else {
           // sử lí với nhiều file
             foreach ($uploadedFiles as $key => $values){
                foreach ($values as $index => $value){
                     $files[$index][$key] = $value;
                }
             }
             $uploadPath = "../uploads/" . date('d-m-Y', time());
             if (!is_dir($uploadPath)){
                  mkdir($uploadPath, 0777, true);
             }
             foreach ($files as $file){
                $Remember_name = $file['name'];
                $file = validateUploadFile($file, $uploadPath);
                if($file == 0 || $file == 1){
                   if($file == 0){
                       $error[] = "*File " .$Remember_name. " Vượt quá 4.5Mb"; 
                   } else if($file == 1){
                       $error[] = "*File ". $Remember_name. " Không đúng với định dạng hình ảnh";
                   }
                   $error[] = true;
                } else {
                  $error[] = $uploadPath . '/' . $file["name"] ;
                    move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"]);
                }
             }
             return ($error);
         }
     }
      // hàm hiển thị ra tất cả file ảnh 
      function getAllFiles(){
        $allFiles = array();
        $allDirs = glob('uploads/*');
        foreach ($allDirs as $dir){
               $allFiles = array_merge($allFiles, glob($dir . "/*"));
        }
        return $allFiles ;
      }
