<?php
require_once ('./Help.php');
 if(!empty($_POST)){
     if(isset($_POST['id'])){
           $id = $_POST['id'];

$sql = 'SELECT * FROM nokia WHERE id = '. $id;


$result = executeSingleResult($sql);

     }
 }

?>
<div >
<?=$result['content']?>
</div>