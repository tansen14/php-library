<?php 

$employee_title = (int)$_POST['employee_title'];
$employee_text = $_POST['employee_text'];

$error = array();

if($_POST['employee_title'] === "")
{
    $error[] = "入力してください";
}
if($_POST['employee_text'] === "")
{
    $error[] = "コメントは必ず入力してください。";
}


?>



<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>register.php</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
   <script type="text/javascript" src="js/bootstrap.js"></script> -->



</head> 

<body>
  <style>
    body{background-color:#DCF0FE;}

  </style>
  
  <form method="POST" action="register.php" class="form"> 
<div class="parent">
<div class="image1">

  <img class="image" src="">
  <!-- src="no-image-800x600.png" -->
   </div>
   <div class="div3"><div class="main1main2">
    
    <div class="main1">
      
      <div>
        
        <input type="file" class="filer">
      </div>
    </div>
    <div class="main2">
      <div>
      <div>
        <input type="submit" value="アップロード" class="app">
      </div>
      </div>
      </div>
    </div>

   </div>
<div class="main3"><div>
       <label class="font ti">書籍タイトル</label><br>
        <input type="text" class="text" name="employee_title">
      </div>
      <div>
      <label class="font cm">コメント</label><br>
        <textarea class="textarea" name="employee_text"></textarea>
      </div>
      <div class="push">
        <input class="btn" type="submit" value="登   録">
      </div>
 </div>

</div>

</form>
</body>
</html>

