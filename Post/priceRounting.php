<?php
require_once ('./Help.php');
  
  if(!empty($_POST)){
    if(isset($_POST['id_product'])){
      $id_product = $_POST['id_product'];
    }
      if(isset($_POST['id'])){
          $id = $_POST['id'];
      }
     // echo $id_product. "<br/>";
    //  echo $id. "<br/>";
    }
?>
<p class="slidePrice">Chọn mức giá:</p>
    <a class="slidePrice" href="javascript:SortingPriceAjax('2tr', <?=$id?>, <?=$id_product?>);">Dưới 2 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('2tr-4tr', <?=$id?>, <?=$id_product?>);">Từ 2 - 4 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('4tr-7tr', <?=$id?>, <?=$id_product?>);">Từ 4 - 7 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('7tr-13tr', <?=$id?>, <?=$id_product?>);">Từ 7 - 13 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('13tr-20tr', <?=$id?>, <?=$id_product?>);">Từ 13 - 20 triệu</a>
    <a class="slidePrice" href="javascript:SortingPriceAjax('20tr', <?=$id?>, <?=$id_product?>);">Trên 20 triệu</a>
  