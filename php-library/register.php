<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>register.php</title>
<link rel="stylesheet" href="css/style.css">
 <link href="css/bootstrap.min.css" rel="stylesheet">
 

</head> 
<body>
<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.js"></script> 
  <style>
    body{background-color:#DCF0FE;
      }

  </style>
  
  <div class="cont">
  <form class="needs-validation" novalidate>
  
<div class="grid-container">

<div class="left">
<div>
<img class="image" id="preview" name=image>   
        <div id="scale" >
        <input class="app" name="image" type="file" id="myImage" accept="image/*" onchange="setImage(this);" onclick="this.value = '';">
        <div class="invalid-feedback">
                    入力してください
                </div>
    

    <script>
    function setImage(target) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview").setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(target.files[0]);
    };
    </script>
    </div>
    </div>
    
</div>
<div class="right">
<div>
<!-- class="fontti" -->
       <label class="fontti">書籍タイトル</label><br>
        <input type="text " class="text form-control" required>
        <div class="invalid-feedback">
                    入力してください
                </div>
        
    <style>
    

   </style>
                
      <div>
      <label class="fontcm" >コメント</label><br>
        <textarea class="textarea form-control"  name="text" required></textarea>
        <style>
          @media screen and (max-width: 600px){
            .invalid-feedback{
              font-size:15px;
            }
    .text.form-control{
      height:25px;
      width:250px;
      font-size:12px;
      border-radius: 6px;
      border: 2px solid #7AAEC4;
      resize:none;
      margin:0 auto;

    }
    .textarea.form-control{
      font-size:15px;
      width:250px;
      height:60px;
      border-radius: 6px;
      border: 2px solid #7AAEC4;
      resize:none;
      margin:0 auto;
    }
    
    
          }
          @media screen and (min-width: 600px){
            .invalid-feedback{
              font-size:25px;
             
            }
            .text.form-control{
        height:60px;
        width:650px;
        font-size:30px;
        border-radius: 10px;
        border: 5px solid #7AAEC4;
        resize:none;
        margin-right: 50px;
        
      }
      
      
      .textarea.form-control{
        font-size:25px;
        width:650px; 
         height:200px;
         margin-right: 50px;
        

        border-radius: 10px;
        border: 5px solid #7AAEC4;
        resize:none;
      
      
      }


          }
  </style>
  

        <div class="invalid-feedback">
                    入力してください
                </div>
        
                <div class="push">
        <input class="btn btn btn-primary" type="submit" value="登   録" name="submit">
        <style>
        @media screen and (min-width: 700px){
    .btn-primary{font-size:30px;}}
        </style>
  
        <!-- <button class="btn btn-primary" type="submit">登  録</button>  -->
      </div>
</div>
</div>
</div>
</form>
</div>
<script>

    
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // カスタムブートストラップ検証スタイルを適用するすべてのフォームを取得
            var forms = document.getElementsByClassName('needs-validation');
            // ループして帰順を防ぐ
            var validation = Array.prototype.filter.call(forms, function(form) {
                // submitボタンを押したら以下を実行
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>