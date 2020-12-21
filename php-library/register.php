<?php
ini_set('log_errors','On');

ini_set('error_log','php.log');

define('MSG01','入力必須です。');
define('MSG08','このタイトルは登録済みです');

$title = $_POST['title'];
$comment = $_POST['comment'];
$file = $_FILES['img'];
$filename = $file['name'];
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';  
// $save_filename = date('YmdHis') . $filename;
$save_filename = $filename;

$save_path = $upload_dir.$save_filename;


$err_msg =array();



if(!empty($_POST)){


  


    if(empty($err_msg)){
      $dsn = 'mysql:dbname=acrovision_library;host=localhost;charaset=utf8mb4';
      $user = 'root';
      $password = 'root';
      $options = array(
        // SQL実行失敗時に例外をスルー
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // デフォルトフェッチモードを連想配列形式に設定
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // バッファードクエリを使う（一度に結果セットを全て取得し、サーバー負荷を軽減）
        // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
      );

      $dbh = new PDO($dsn,$user,$password,$options);

      $query = $dbh->prepare('SELECT * FROM books WHERE title= :title limit 1');

      $query->execute(array(':title' => $title));

      $result = $query->fetch();


      if($result > 0){

        $err_msg['title'] = MSG08; 
        
      }else{
        move_uploaded_file($tmp_path, $save_path);
        $stmt = $dbh->prepare('INSERT INTO books(title,img,comment) VALUES (:title,:img,:comment)');

        $stmt->execute(array(':title' => $title,':img' => $save_path,':comment' => $comment));

        header("Location:register.php");
        }
      

    }

}






?>





<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>register.php</title>
<link rel="stylesheet" href="css/style.css">
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head> 
<style>
@media screen and (min-width: 600px){ 
  
  .grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr;
    gap: 0px 0px;
    grid-template-areas:
      "left right";
    margin-top:160px;
    /* align-items: center;
    place-items: center; */
    
  }
  
  .left { grid-area: left;
    margin-left:80px;
    margin-right: 50px;
    
   }
  
  .right { 
    /* width:100%; */
    grid-area: right; 
    /* margin-right:30px; */
    /* text-align: center; */
    /* margin:0 auto; */
   /* align-self: center; */
   position: relative;
   left:50%;
   transform: translate(-50%);
  }
  .image{
          
    background-color: white;
    /* position:relative;
    top:10px;  */
     width: 380px;
    height: 360px; 
    border: 5px solid #7AAEC4;
      }
      
      .app{
        border:1px solid gray ;
        background-color: white;
        padding: 1px;
        /* margin-left:50px; */
        /* margin-bottom:100px; */
        margin-top:30px;
        width:380px;
      }
      .text{
        height:60px;
        width:650px;
        font-size:30px;
        border-radius: 10px;
        border: 5px solid #7AAEC4;
        resize:none;
        margin-right: 50px;
        
      }
      
      
      .textarea{
        font-size:25px;
        width:650px; 
         height:200px;
         margin-right: 50px;
        

        border-radius: 10px;
        border: 5px solid #7AAEC4;
        resize:none;
      
      
      }
      .fontti{
        font-size:30px; 
        
        /* margin-bottom:5px;
        display:inline-block;
        white-space: nowrap;
       margin-right:170px;
        position: relative;
        bottom:-13px;   */
      }
      .fontcm{
        /* margin-top:100px; */
        font-size:30px;
        
/*         
        margin-bottom:5px;
        display:inline-block;
        white-space: nowrap;
       margin-right:190px;
       position: relative;
        bottom:-3px; */
       
        
      }
      .btn{
        margin-left:400px;
        margin-top:10px;
        
        width:230px;
        height:60px;
        font-size:100px;
        background-color:#138EE1;
        color:white;
        border-radius: 5px;
        border: none;
        box-shadow: 0px 4px #043152;
      }
      .btn:active{
        position:relative;
        top:2px;
        box-shadow: none;
      }


      
}
@media screen and (max-width: 600px){
.cont{
   
  text-align: center; 
  
}
.image{            
  background-color: white; 
  width: 200px;
  height: 230px; 
  margin-top:100px;
  border: 2px solid#7AAEC4;
    }
    /* #scale{
      transform: scale(0.6);
    } */
    .app{
          border:1px solid gray ;
          background-color: white;
          margin-bottom:20px;
          /* width:50px; */
          width:200px;
          font-size:10px;
    }
    .text{
      height:25px;
      width:250px;
      font-size:12px;
      border-radius: 6px;
      border: 2px solid #7AAEC4;
      resize:none;
      
      
    }
    .fontti{
      
    }
    
    
    .textarea{
      font-size:15px;
      width:250px;
      height:60px;
      border-radius: 6px;
      border: 2px solid #7AAEC4;
      resize:none;
    
    

    }
    
    .fontcm{

    }
    /* .btn{
      
      margin-top:20px;
      width:90px;
      font-size:100px;
      background-color:#138EE1;
      color:white;
      border-radius: 5px;
      border: none;
      box-shadow: 0px 4px #043152;
    } */
    .btn:active{
      position:relative;
      top:2px;
      box-shadow: none;
    }
  }

</style>
<body>
<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.js"></script> 
  <style>
    body{background-color:#DCF0FE;
      }

  </style>
  
  <div class="cont">
  <form class="needs-validation" action="register.php" method="post"novalidate
  enctype="multipart/form-data">
  
<div class="grid-container">

<div class="left">
<!-- <div> -->
<img class="image" id="preview" name=image>   
        <div>
        <!-- id="myImage" -->
        <input type="hidden" name="MAX_FILE_SIZE" />
        <input class="app form-control" name="img" type="file" 
         accept="image/*" onchange="setImage(this);" onclick="this.value = '';"
        required>
        <div class="invalid-feedback" >
                    ※画像を選択してください
                </div>
                <style>@media screen and (max-width: 600px){
         .app.form-control{
            border:1px solid gray ;
            background-color: white;
            margin-bottom:20px;
            
            width:200px;
            font-size:10px;
            margin:0 auto;
            height:23px;
            padding:0;
            }
          }
          @media screen and (min-width: 600px){
            .app.form-control{
        border:3px solid gray ;
        background-color: white;
        padding: 1px;
        /* margin-left:50px; */
        /* margin-bottom:100px; */
        margin-top:30px;
        width:380px;
        height:38px;
      }
          }
                </style>
    

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
    
<!-- </div> -->
<div class="right">
<div>
<!-- class="fontti" -->

       <!-- <label class="fontti"> -->
       <label class="fontti <?php if(!empty($err_msg['title'])) echo 'err'; ?>">書籍タイトル</label><br>
        <input  type="text " class="text form-control" 
        name="title"
        value="<?php if(!empty($_POST['title'])) echo $_POST['title']; ?>" required>
        <div class="area-msg">
        <?php
          if(!empty($err_msg['title'])) echo $err_msg['title'];
          ?>
        </div>
        <div class="invalid-feedback">
        ※タイトルを入力してください
        
                </div>

        
    <style>
    

   </style>
                
      <div>
      <label class="fontcm" >コメント</label><br>
        <textarea class="textarea form-control"  name="comment" required></textarea>
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
    .area-msg{
      color: #dc3545;
    }
    .btn-primary{
      margin-top: 5px;
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
      .area-msg{
      color: #dc3545;
      font-size: 25px;
    }
    
    
}


          }
  </style>
  

        <div class="invalid-feedback">
        ※コメントを入力してください
                </div>
        
                <div class="push">
        <input class="btn btn btn-primary" type="submit" value="登   録">
        <style>
        @media screen and (min-width: 700px){
    .btn-primary{font-size:30px;
    }}
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